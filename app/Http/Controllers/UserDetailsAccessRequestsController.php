<?php

namespace banking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use banking\Http\Requests;
use banking\Models\UserDetailsAccessRequest;
use banking\Models\BankUser;
use banking\Models\UserDetail;
use banking\Models\Bank;
use banking\Models\User;

class UserDetailsAccessRequestsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
    $requests = UserDetailsAccessRequest::where('requester_id', $this->currentUser()->id)->get();
    $requestsArray = [];
    foreach ($requests as $request) {
      array_push($requestsArray, [
        'id' => $request->id,
        'user_name' => User::find($request->user_id)->name,
        'detail_title' => UserDetail::find($request->detail_id)->detail_title,
        'status' => $request->seen == 0 ? 'Not Seen' : ($request->granted == 0 ? 'Rejected' : 'Granted'),
        'colorCode' => $request->seen == 0 ? '' : ($request->granted == 0 ? '#fb5353' : '#49f349'),
      ]);
    }

    return view('user-details-access-requests.index', ['requests' => $requestsArray]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
  //
    if ($this->currentUser()->user_type_id == 3) {
      $userDetailsAccessRequest = new UserDetailsAccessRequest();
      $APIUserBanks = [];
      $APIUserBankDetails = BankUser::where('user_id', $this->currentUser()->id)->where('bank_user_type_id', 2)->get();
      foreach ($APIUserBankDetails as $APIUserBankDetail) {
        $bank = Bank::find($APIUserBankDetail->bank_id);
        array_push($APIUserBanks, $bank);
      }
      
      return view('user-details-access-requests.create', ['userDetailsAccessRequest' => $userDetailsAccessRequest, 'APIUserBanks' => $APIUserBanks]);
    } else {
      return view('home.index', ['message' => null]);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
    $detailTitle = UserDetail::find($request['detail_id'])->detail_title;
    $message = '';
    $verified = BankUser::where('token', bcrypt($request['token']));
    if (count($verified)) {
      $userDetailsAccessRequest = UserDetailsAccessRequest::where('user_id', $request['user_id'])->where('requester_id', $request['requester_id'])->where('seen', 0)->where('detail_id', $request['detail_id'])->get();
      if (count($userDetailsAccessRequest) > 0) {
        $message = "Request for $detailTitle has already been sent and awaiting response from user.";
      } else {
        UserDetailsAccessRequest::create(array(
          'user_id' => $request['user_id'],
          'requester_id' => $request['requester_id'],
          'detail_id' => $request['detail_id'],
          'seen' => 0,
          'granted' => 0
        ));
        $message = "Request for $detailTitle successfully sent.";
      }
      return view('home', ['message' => $message, 'userDetailsAccessRequests' => []]);
    } else {
      return view('home', ['message' => $message, 'userDetailsAccessRequests' => []]);
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
    $request = UserDetailsAccessRequest::find($id);
    $requestDetails = [
      'User Name' => User::find($request->user_id)->name,
      'Detail Title' => UserDetail::find($request->detail_id)->detail_title,
      'Detail Value' => UserDetail::find($request->detail_id)->details
    ];

    return view('user-details-access-requests.show', ['requestDetails' => $requestDetails]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
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
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }
}
