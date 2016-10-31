@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Edit Bank User</div>
        <div class="panel-body">
          {{Form::model($bankUser, ['route' => ['bank-users.update', $bankUser->id], 'class' => 'form-horizontal', 'role' => 'form'])}}
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            @include('admin.bank-users.form')
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
