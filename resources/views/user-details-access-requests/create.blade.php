@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">New User Detail Request</div>
        <div class="panel-body">
          {{Form::model($userDetailsAccessRequest, ['route' => ['user-details-access-requests.store', $userDetailsAccessRequest->id], 'class' => 'form-horizontal', 'role' => 'form'])}}
            {{ csrf_field() }}
            @include('user-details-access-requests.form')
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
