@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
          @if (count($requestDetails) > 0)
            <div class="wrapper">
              @foreach ($requestDetails as $key => $value)
                <div style="clear:both;margin-bottom:30px;">{{$key}}: <strong>{{$value}}</strong></div>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No Detail Available</strong>.
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
