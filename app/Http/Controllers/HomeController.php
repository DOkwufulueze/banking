<?php

namespace banking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use banking\Http\Requests;

class HomeController extends Controller
{
  //
  function index() {
    if ($this->currentUser()) {
      return $this->currentUser()->user_type_id == 1 ? Redirect::to('admin/home') : view('home', ['message' => null, 'userDetailsAccessRequests' => $this->fetchRequests()]);
    } else {
      return view('home', ['message' => null, 'userDetailsAccessRequests' => $this->fetchRequests()]);
    }
  }
}
