@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-user-secret"></i>User Manager</li>
</ol>
@endsection
 
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-user-secret"></i>User Manager</h1></span>
		    	<hr>
		    	<span class="pull-right"><a href="/user/create" class="btn btn-success">Add User</a></span>
		 	</div>
		 	<div class="box-body table-responsive">
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
		            <thead>
		                <tr>
		                    <th>Name</th>
		                    <th>Username</th>
		                    <th>Email</th>
		                    <th>Level</th>
		                    <th>Date/Time Added</th>
		                    <th>Last Updated</th>
		                    <th width="200"></th>
		                </tr>
		            </thead>
		 
		            <tbody>
		                @foreach ($users as $user)
		                <tr>
		                    <td>{{ $user->getFullName() }}</td>
		                    <td>{{ $user->name }}</td>
		                    <td>{{ $user->email }}</td>
		                    <td>{{ $user->level }}</td>
		                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
		                    <td>{{ $user->updated_at->format('F d, Y h:ia') }}</td>
		                    <td>
		                        <a href="/user/{{ $user->id }}" class="btn btn-warning pull-left" style="margin-right: 3px;">View</a>
		                        <a href="/user/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
		                        {!! Form::open(['url' => '/user/' . $user->id, 'method' => 'DELETE']) !!}
		                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!}
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>
		        </table>
   			    <div class="pull-right">{!! $users->render() !!}</div>
		    </div>
	 	</div>
	</div>
</div>
@endsection