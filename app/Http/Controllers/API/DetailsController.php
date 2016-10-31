<?php

namespace banking\Http\Controllers\API;

use Illuminate\Http\Request;
use banking\Http\Controllers\Controller;
use banking\Models\UserDetailsAccessRequest;
use banking\Models\UserDetail;

class DetailsController extends Controller
{
  public function action(Request $request) {
    //
    $requestObject = json_decode($request['dataSet']);
    $userDetailsAccessRequest = UserDetailsAccessRequest::find($requestObject->id);
    $message = '';
    if (is_null($userDetailsAccessRequest)) {
      return ['status' => 0, 'message' => 'No Request found for your detail'];
    } else {
      if ($requestObject->action == 'approve') {
        $userDetailsAccessRequest->update(array(
          'seen' => 1,
          'granted' => 1
        ));
        $message = 'Request successfully granted';
      } else if ($requestObject->action == 'reject') {
        $userDetailsAccessRequest->update(array(
          'seen' => 1,
          'granted' => 0
        ));
        $message = 'Request successfully rejected';
      }
      return ['status' => 1, 'message' => $message];
    }
  }

  public function getDetails(Request $request) {
    $requestObject = json_decode($request['dataSet']);
    $userDetails = UserDetail::where('user_id', $requestObject->user_id)->where('authorization_level_id', '<=', $requestObject->authorization_level_id)->get();
    $userDetailsArray = [];
    foreach ($userDetails as $userDetail) {
      array_push($userDetailsArray, [
        'id' => $userDetail->id,
        'content' => $userDetail->detail_title
      ]);
    }
    return ['details' => $userDetailsArray];
  }  
}
