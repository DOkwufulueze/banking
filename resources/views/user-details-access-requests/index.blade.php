@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
          @if (count($requests) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row" style="width:750px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 250px;float:left;">NAME</div>
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 200px;float:left;">DETAIL</div>
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 120px;float:left;">STATUS</div>
                <div class="data-column" style="background: {{$colorCodes[1]}};width: 120px;float:left;"></div>
              </div>
              @foreach ($requests as $request)
                <div class="data-row" style="width:750px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 250px;float:left;">{{ $request['user_name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 200px;float:left;">{{ $request['detail_title'] }}</div>
                  <div class="data-column" style="background: {{ $request['status'] == 'Not Seen' ? $colorCodes[$i] : $request['colorCode'] }};width: 120px;float:left;">{{ $request['status'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}};width: 120px;float:left;">
                    <?php if ($request['status'] == 'Granted') { ?>
                      <a href="http://localhost:8000/user-details-access-requests/{{$request['id']}}">View Detail</a>
                    <?php } ?>
                  </div>
                </div>
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No Request Available</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000/home">Home</a>
            <a href="http://localhost:8000/banks">Banks</a>
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
@endsection
