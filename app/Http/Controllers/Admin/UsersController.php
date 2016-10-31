<?php

namespace banking\Http\Controllers\Admin;

use Illuminate\Http\Request;
use banking\Http\Controllers\Controller;
use banking\Models\User;
use banking\Models\UserType;

class UsersController extends Controller
{
  //
  public function index() {
    //
    $users = User::whereIn('user_type_id', [2, 3])->get();
    $usersArray = [];
    foreach ($users as $user) {
      $userType = UserType::find($user->user_type_id);
      array_push($usersArray, [
        'object' => $user,
        'objectType' => $userType
      ]);
    }
    return view('admin.users.index', ['users' => $usersArray]);
  }
}
