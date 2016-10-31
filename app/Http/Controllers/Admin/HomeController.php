<?php

namespace banking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use banking\Http\Requests;
use banking\Http\Controllers\Controller;

class HomeController extends Controller
{
  //
  function index() {
    return view('admin.home');
  }
}
