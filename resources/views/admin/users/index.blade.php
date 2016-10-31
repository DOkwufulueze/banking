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
              <div class="data-row" style="width:920px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 250px;">NAME</div>
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 250px;">USER TYPE</div>
              </div>
              @foreach ($users as $user)
                <div class="data-row" style="width:920px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 250px;">{{ $user['object']->name }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 250px;">{{ $user['objectType']->name }}</div>
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
            <a href="http://localhost:8000/admin/home">Home</a>
            <a href="http://localhost:8000/admin/banks">Banks</a>
            <a href="http://localhost:8000/admin/user-details">User Details</a>
            <a href="http://localhost:8000/admin/bank-users">Bank Users</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
