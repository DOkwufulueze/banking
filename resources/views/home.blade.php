@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard {{$message ? '('.$message.')' : ''}}</div>

                <div class="panel-body">
                    <div class="links">
                        <a href="http://localhost:8000/home">Home</a> &middot;
                        <a href="http://localhost:8000/banks">Banks</a>
                        @if (Auth::user())
                          @if (Auth::user()->user_type_id == 3)
                            <a href="http://localhost:8000/user-details-access-requests/create">Make Bank Request</a>
                            <a href="http://localhost:8000/user-details-access-requests">View Requests Made</a>
                          @endif
                        @endif
                        @if (count($userDetailsAccessRequests) > 0)
                          <button onclick="showModal('requests-holder')">Details' Requests</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (count($userDetailsAccessRequests) > 0)
  <?php
    $i = 0;
    $colorCodes = ['#dedede', '#efefef'];
  ?>
  <div id="requests-holder" class="wrapper">
    <div class="modal-close">Close</div>
    <div class="data-row" style="width:780px;height:20px;">
      <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">REQUESTER</div>
      <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">REQUEST FOR</div>
      <div class="data-column" style="background: #{{$colorCodes[1]}}; width: 70px;height:20px;"> </div>
      <div class="data-column" style="background: #{{$colorCodes[1]}}; width: 70px;height:20px;"> </div>
    </div>
    @foreach ($userDetailsAccessRequests as $userDetailsAccessRequest)
      <div class="data-row" style="width:780px;height:20px;">
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $userDetailsAccessRequest['requester'] }}</div>
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $userDetailsAccessRequest['name'] }}</div>
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 
        70px;">
          <label style="height:20px !important;cursor:pointer" onclick="manageRequest(this, {{$userDetailsAccessRequest['id']}}, 'approve')">Approve</label>
        </div>
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 
        70px;">
          <label style="height:20px !important;cursor:pointer" onclick="manageRequest(this, {{$userDetailsAccessRequest['id']}}, 'reject')">Reject</label>
        </div>
      </div>
      <?php $i = $i % 2 == 0 ? 1 : 0 ?>
    @endforeach
  </div>
@else
  @if (Auth::user())
    <div class="wrapper">
      <strong>No Request for your details has been made</strong>.
    </div>
  @endif
@endif
@endsection
