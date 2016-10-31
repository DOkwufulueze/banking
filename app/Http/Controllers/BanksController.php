<?php

namespace banking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use banking\Http\Requests;
use banking\Models\User;
use banking\Models\Bank;

class BanksController extends Controller
{
  //
  function index() {
    $banks = Bank::all();
    return view('banks.index', ['banks' => $banks, 'userDetailsAccessRequests' => $this->fetchRequests()]);
  }
}
