<?php

namespace banking\Http\Controllers\API;

use Illuminate\Http\Request;
use banking\Http\Controllers\Controller;
use banking\Models\BankUser;
use banking\Models\User;

class UsersController extends Controller
{
  //
  public function getUsers(Request $request) {
    $requestObject = json_decode($request['dataSet']);
    $bankUsers = BankUser::where('bank_id', $requestObject->bank_id)->where('bank_user_type_id', 1)->get();
    $users = [];
    foreach ($bankUsers as $bankUser) {
      array_push($users, [
        'id' => $bankUser->user_id,
        'name' => User::find($bankUser->user_id)->name,
      ]);
    }
    $authorizationLevelIds = BankUser::where('user_id', $requestObject->requester_id)->where('bank_id', $requestObject->bank_id)->where('token', $requestObject->token)->get();
    if (count($authorizationLevelIds) > 0) {
      return ['status' => 1, 'users' => $users, 'authorizationLevelId' => $authorizationLevelIds[0]->authorization_level_id];
    } else {
      return ['status' => 0, 'message' => 'Invalid Security Token'];
    }
  }
}
