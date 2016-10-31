<?php

namespace banking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use banking\Http\Requests;
use banking\Http\Controllers\Controller;
use banking\Models\User;
use banking\Models\Bank;
use banking\Models\BankUser;
use banking\Models\BankUserType;
use banking\Models\AuthorizationLevel;

class BankUsersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
    $bankUsers = BankUser::all();
    $bankUsersArray = [];
    foreach ($bankUsers as $bankUser) {
      $bank = Bank::find($bankUser->bank_id);
      $user = User::find($bankUser->user_id);
      $bankUserType = BankUserType::find($bankUser->bank_user_type_id)->name;

      array_push($bankUsersArray, [
        'id' => $bankUser->id,
        'bank' => $bank,
        'user' => $user,
        'bankUserType' => $bankUserType
      ]);
    }

    return view('admin.bank-users.index', ['bankUsers' => $bankUsersArray]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $token = '';
    $authorizationLevels = AuthorizationLevel::all();
    $bankUser = new BankUser();
    $banks = Bank::all();
    $users = User::whereIn('user_type_id', [2, 3])->get();
    $bankUserTypes = BankUserType::all();
    for ($i=0; $i < 10; $i++) { 
      $token .= $alphabet[mt_rand(0, strlen($alphabet) - 1)];
    }

    $bankUser->token = $token;
    return view('admin.bank-users.create', ['authorizationLevels' => $authorizationLevels, 'bankUserTypes' => $bankUserTypes, 'banks' => $banks, 'users' => $users, 'bankUser' => $bankUser]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
    $bankUser = BankUser::where('bank_id', $request['bank_id'])->where('user_id', $request['user_id'])->where('bank_user_type_id', $request['bank_user_type_id'])->get();
    if (count($bankUser) > 0) {
      return Redirect::to('admin/bank-users');
    } else {
      BankUser::create([
        'authorization_level_id' => $request['authorization_level_id'],
        'bank_user_type_id' => $request['bank_user_type_id'],
        'bank_id' => $request['bank_id'],
        'user_id' => $request['user_id'],
        'token' => $request['token'] ? bcrypt($request['token']) : ''
      ]);

      return Redirect::to('admin/bank-users');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
    $authorizationLevels = AuthorizationLevel::all();
    $bankUser = BankUser::find($id);
    $banks = Bank::all();
    $users = User::all();
    $bankUserTypes = BankUserType::all();
    return view('admin.bank-users.edit', ['authorizationLevels' => $authorizationLevels, 'bankUserTypes' => $bankUserTypes, 'banks' => $banks, 'users' => $users, 'bankUser' => $bankUser]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
    $bankUser = BankUser::findOrFail($id);
    if (is_null($bankUser)) {
      return Redirect::to('home');
    } else {
      if ($bankUser->bank_user_type_id == $request['bank_user_type_id']) {
        $message = 'This user already exists with selected user type';
      } else {
        $bankUser->update([
          'authorization_level_id' => $request['authorization_level_id'],
          'bank_user_type_id' => $request['bank_user_type_id']
        ]);
        $message = 'Update successful';
      }
      return Redirect::to('admin/bank-users');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
    $bankUser = BankUser::findOrFail($id);
    $bankUser->delete();
    return Redirect::to('admin/bank-users');
  }
}
