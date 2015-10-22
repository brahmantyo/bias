@extends('app')

@section('content-header')
<h1>
User Manager
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/user"><i class="fa fa-dashboard"></i>User Manager</a></li>
    <li class="active">Profile</li>
</ol>
@endsection

@section('content')
 
<div class='col-lg-10 col-lg-offset-1'>
 
    <h1><i class='fa fa-user'></i>User Profile</h1>
 
    <div class="well col-lg-12">
        <div class="col-lg-6">
            <img src="{{ asset($user->photo) }}" class="img-circle" style="max-height: 100%; max-width: 100%;" alt="User Image" />
        </div>
        <div class="col-lg-6">
            <table height="100%">
                <tr><td>Nama</td><td> : {{ $user->first_name.' '.$user->last_name }}</td></tr>
                <tr><td>Email</td><td> : {{ $user->email }}</td></tr>
                <tr><td>Member since</td><td> : {{ $user->created_at->format('d F Y') }}</td></tr>
                <tr><td>Level</td><td> : {{ $user->level }}</td></tr>
            </table>
            <a href="#" onclick="history.back();" class="btn btn-warning pull-left" style="margin-right: 3px;">Back</a>
            <a href="/user/{{$user->id}}/edit" class="btn btn-default btn-flat">Edit</a>
        </div>
    </div>

</div>
 
@endsection