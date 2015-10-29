@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Permissions</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-share-alt"></i>Daftar Permissions</h1></span>
				<span class="pull-right"><a class="btn btn-success" id="tambah" href="/admin/permission/create">Tambah</a></span>		    	
		 	</div>
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
		 	<div class="box-body table-responsive">
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
					<thead>
						<tr style="font-weight: bold">
							<td>ID</td>
							<td>Permission Name</td>
							<td>Permission Desc</td>
							<td width="200"></td>
						</tr>
					</thead>
					<tbody>
						@foreach($permission as $list)
						<tr>
							<td>{{ $list->privilegesid }}</td>
							<td>{{ $list->privilegesname }}</td>
							<td>{{ $list->privilegesdesc }}</td>
							<td>
								<a class="btn btn-info pull-left" href="/admin/permission/{{$list->privilegesid}}/edit" style="margin-right: 3px;">Edit</a>
						        {!! Form::open(['url' => '/admin/permission/' . $list->privilegesid, 'method' => 'DELETE']) !!}
	                        	{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!}
							</td>
						</tr>
						@endforeach
					</tbody>
		        </table>
   		        {!! $permission->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection