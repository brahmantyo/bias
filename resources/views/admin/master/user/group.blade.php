@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-users"></i>Group User Administration</li>
</ol>
@endsection
 
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-user-secret"></i>Group User Administration</h1></span>
		    	<span class="pull-right"><a href="/admin/group/create" class="btn btn-success">Add Group</a></span>
		 	</div>
		 	<div class="box-body table-responsive">
		 		@if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
		            <thead>
		                <tr>
		                    <th>Id</th>
		                    <th>Group Name</th>
		                    <th>Parent</th>
		                    <th>Status</th>
		                    <th>Date/Time Added</th>
		                    <th>Last Updated</th>
		                    <th width="200"></th>
		                </tr>
		            </thead>
		 
		            <tbody>
		                @foreach ($groups as $group)
		                <tr>
		                    <td>{{ $group->groupid }}</td>
		                    <td>{{ $group->groupname }}</td>
		                    <td>{{ $group->parent }}</td>
		                    <td>{{ $group->status?'Enabled':'Disabled' }}</td>
		                    <td>{{ $group->created_at->format('d M Y h:ia') }}</td>
		                    <td>{{ $group->updated_at->format('d M Y h:ia') }}</td>
		                    <td>
		                        <a href="/admin/group/{{ $group->groupid }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
		                        {!! Form::open(['url' => '/admin/group/' . $group->groupid, 'method' => 'DELETE']) !!}
		                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!}
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>
		        </table>
   			    <div class="pull-right">{!! $groups->render() !!}</div>
		    </div>
	 	</div>
	</div>
</div>
@endsection