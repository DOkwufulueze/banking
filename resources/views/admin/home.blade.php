@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="links">
                        <a href="http://localhost:8000/admin/home">Home</a> &middot;
                        <a href="http://localhost:8000/admin/users">Users</a> &middot;
                        <a href="http://localhost:8000/admin/banks">Banks</a> &middot;
                        <a href="http://localhost:8000/admin/user-details">User Details</a> &middot;
                        <a href="http://localhost:8000/admin/bank-users">Bank Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
