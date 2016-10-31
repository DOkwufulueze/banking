@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
          @if (count($users) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row" style="width:300px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 250px;">NAME</div>
              </div>
              @foreach ($users as $user)
                <div class="data-row" style="width:300px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 250px;">{{ $user->name }}</div>
                </div>
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No User Available</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000/home">Home</a>
            <a href="http://localhost:8000/banks">Banks</a>
            @if (Auth::user())
              @if (Auth::user()->user_type_id == 3)
                <a href="http://localhost:8000/user-details-access-requests/create">Make Bank Request</a>
                <a href="http://localhost:8000/user-details-access-requests">View Requests Made</a>
              @endif
            @endif
            @if (count($userDetailsAccessRequests) > 0)
              <button onclick='showModal('requests')'>Details' Requests</button>
            @endif
            @if (Auth::user())
              @if (Auth::user()->user_type_id == 1)
                <a href="http://localhost:8000/admin/bank-users">Bank Users</a>
              @endif
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
    <div class="data-row" style="width:920px;height:20px;">
      <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">REQUESTER</div>
      <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">REQUEST FOR</div>
      <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
      <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
    </div>
    @foreach ($userDetailsAccessRequests as $userDetailsAccessRequest)
      <div class="data-row" style="width:920px;height:20px;">
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $userDetailsAccessRequest['name'] }}</div>
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $userDetailsAccessRequest['request_for'] }}</div>
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;">
          {{Form::open(['method' => 'PUT', 'route' => ['user-details-access-requests.approve', $userDetailsAccessRequest['id']]])}}
            {{Form::submit('Approve', ['class' => 'action-button', 'style' => 'height:20px;font-size:11px;', 'onmousedown' => 'confirmApproval(this, true)'])}}
          {{Form::close()}}
        </div>
        <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;">
          {{Form::open(['method' => 'PUT', 'route' => ['user-details-access-requests.reject', $userDetailsAccessRequest['id']]])}}
            {{Form::submit('Reject', ['class' => 'action-button', 'style' => 'height:20px;font-size:11px;', 'onmousedown' => 'confirmApproval(this, false)'])}}
          {{Form::close()}}
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
