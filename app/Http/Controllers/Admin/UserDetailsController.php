<?php

namespace banking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use banking\Http\Requests;
use banking\Http\Controllers\Controller;
use banking\Models\User;
use banking\Models\AuthorizationLevel;
use banking\Models\UserDetail;

class UserDetailsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
    $userDetails = UserDetail::all();
    $userDetailsArray = [];
    foreach ($userDetails as $userDetail) {
      $user = User::find($userDetail->user_id);

      array_push($userDetailsArray, [
        'id' => $userDetail->id,
        'user' => $user,
        'detail_title' => $userDetail->detail_title,
        'details' => $userDetail->details
      ]);
    }

    return view('admin.user-details.index', ['userDetails' => $userDetailsArray]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
    $authorizationLevels = AuthorizationLevel::all();
    $userDetail = new UserDetail();
    $users = User::where('user_type_id', 2)->get();
    return view('admin.user-details.create', ['authorizationLevels' => $authorizationLevels, 'users' => $users, 'userDetail' => $userDetail]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
    $userDetail = UserDetail::where('user_id', $request['user_id'])->where('detail_title', $request['detail_title'])->where('details', $request['details'])->get();
    if (count($userDetail) > 0) {
      return Redirect::to('admin/user-details');
    } else {
      UserDetail::create([
        'authorization_level_id' => $request['authorization_level_id'],
        'user_id' => $request['user_id'],
        'detail_title' => $request['detail_title'],
        'details' => $request['details']
      ]);

      return Redirect::to('admin/user-details');
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
    $userDetail = UserDetail::find($id);
    $users = User::all();
    return view('admin.user-details.edit', ['authorizationLevels' => $authorizationLevels, 'users' => $users, 'userDetail' => $userDetail]);
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
    $userDetail = UserDetail::find($id);
    if (is_null($userDetail)) {
      return Redirect::to('admin/user-details');
    } else {
      $userDetail->update([
        'authorization_level_id' => $request['authorization_level_id'],
        'detail_title' => $request['detail_title'],
        'details' => $request['details']
      ]);

      return Redirect::to('admin/user-details');
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
    $userDetail = UserDetail::findOrFail($id);
    $userDetail->delete();
    return Redirect::to('admin/user-details');
  }
}
