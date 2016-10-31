<?php

namespace banking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use banking\Http\Requests;
use banking\Http\Controllers\Controller;
use banking\Models\Bank;

class BanksController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()  {
  //
    $banks = Bank::all();
    return view('admin.banks.index', ['banks' => $banks]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()  {
  //
    $bank = new Bank();
    return view('admin.banks.create', ['bank' => $bank]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)  {
  //
    Bank::create([
      'name' => $request['name']
    ]);

    return Redirect::to('admin/banks');
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
    $bank = Bank::findOrFail($id);
    return view('admin.banks.edit', ['bank' => $bank]);
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
    $bank = Bank::findOrFail($id);
    if (is_null($bank)) {
      return Redirect::to('home');
    } else {
      $bank->update([
        'name' => $request['name']
      ]);

      return Redirect::to('admin/banks');
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
    $bank = Bank::findOrFail($id);
    $bank->delete();
    return Redirect::to('admin/banks');
  }
}
