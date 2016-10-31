<?php

namespace banking\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use banking\Models\UserDetailsAccessRequest;
use banking\Models\UserDetail;
use banking\Models\User;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function currentUser() {
    return Auth::user();
  }

  function fetchRequests() {
    $requests = [];
    if ($this->currentUser()) {
      $pendingRequests = UserDetailsAccessRequest::where('user_id', $this->currentUser()->id)->where('granted', 0)->where('seen', 0)->get();
      if (count($pendingRequests) > 0) {
        foreach ($pendingRequests as $pendingRequest) {
          array_push($requests, [
            'id' => $pendingRequest->id,
            'requester' => User::find($pendingRequest->requester_id)->name,
            'name' => UserDetail::find($pendingRequest->detail_id)->detail_title
          ]);
        }
      }
    }

    return $requests;
  }
}
