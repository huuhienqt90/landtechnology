@extends('layouts.front.master-dashboard')

@section('meta')
    <title>Dashboard - Land Technology</title>
@stop

@section('content-dashboard')
    <h3 style="visibility: hidden;">Edit My Account</h3>
    @if(Session::has('msgOk'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Well done!</strong> {{ Session::get('msgOk') }}
        </div>
    @endif
    @if(Session::has('msgEr'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> {{ Session::get('msgEr') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Dashboard</h3>
        </div>
        <div class="panel-body">
            <p>Admin Dashboard Accordion List Group Menu</p>
            <div class="alert alert-success"><h3>Yes! It's compatible with BS 3.0.3, 3.1 & 3.2 </h3></div>
        </div>
    </div>
@stop