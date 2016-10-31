@extends('layouts.app')
<link href="{{URL::asset('css/shared.css')}}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Banks</div>
        <div class="panel-body">
          @if (count($banks) > 0)
            <?php
              $i = 0;
              $colorCodes = ['#dedede', '#efefef'];
            ?>
            <div class="wrapper">
              <div class="data-row" style="width:920px;height:20px;">
                <div class="data-column" style="background: {{$colorCodes[1]}}; width: 300px;">NAME</div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
                <div class="data-column" style="background: #ffffff; width: 50px;height:20px;"> </div>
              </div>
              @foreach ($banks as $bank)
                <div class="data-row" style="width:920px;height:20px;">
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 300px;">{{ $bank['name'] }}</div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;"><a href="/admin/banks/{{$bank['id']}}/edit">Edit</a></div>
                  <div class="data-column" style="background: {{$colorCodes[$i]}}; width: 50px;">
                    {{Form::open(['method' => 'DELETE', 'route' => ['banks.destroy', $bank['id']]])}}
                      {{Form::submit('Delete', ['class' => 'delete-button', 'style' => 'height:20px;font-size:11px;', 'onmousedown' => "confirmDelete(this, 'Bank')"])}}
                    {{Form::close()}}
                  </div>
                </div>
                <?php $i = $i % 2 == 0 ? 1 : 0 ?>
              @endforeach
            </div>
          @else
            <div class="wrapper">
              <strong>No Bank Available</strong>.
            </div>
          @endif
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="line-break"></div>
          <div class="links">
            <a href="http://localhost:8000/admin/home">Home</a>
            <a href="http://localhost:8000/admin/users">Users</a>
            <a href="http://localhost:8000/admin/bank-users">Bank Users</a>
            <a href="http://localhost:8000/admin/user-details">User Details</a>
            <a href="http://localhost:8000/admin/banks/create">Create Bank</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
