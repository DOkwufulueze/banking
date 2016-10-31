@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">User Details</div>
        <div class="panel-body">
          @if (count($userDetails) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row" style="width:920px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 250px;">USER</div>
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 250px;">DETAIL TITLE</div>
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 250px;">DETAIL</div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
              </div>
              @foreach ($userDetails as $userDetail)
                <div class="data-row" style="width:920px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 250px;">{{ $userDetail['user']->name }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 250px;">{{ $userDetail['detail_title'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 250px;">{{ $userDetail['details'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;"><a href="/admin/user-details/{{$userDetail['id']}}/edit">Edit</a></div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;">
                    {{Form::open(['method' => 'DELETE', 'route' => ['user-details.destroy', $userDetail['id']]])}}
                      {{Form::submit('Delete', ['class' => 'delete-button', 'style' => 'height:20px;font-size:11px;', 'onmousedown' => "confirmDelete(this, 'User Detail')"])}}
                    {{Form::close()}}
                  </div>
                </div>
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No User Detail Available</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000/admin/home">Home</a>
            <a href="http://localhost:8000/admin/users">Users</a>
            <a href="http://localhost:8000/admin/banks">Banks</a>
            <a href="http://localhost:8000/admin/bank-users">Bank Users</a>
            <a href="http://localhost:8000/admin/user-details/create">Create User Detail</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
