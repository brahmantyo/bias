@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-users"></i>Sales Management</li>
</ol>
@endsection
 
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-user-secret"></i>Sales Management</h1></span>
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
		                    <th>Nama Sales</th>
		                    <th>Telp Kontak</th>
		                    <th>Divisi</th>
		                    <th width="130"></th>
		                </tr>
		            </thead>
		 
		            <tbody>
		                @foreach ($sales as $s)
		                <tr>
		                    <td>{{ $s->idsales }}</td>
		                    <td>{{ $s->nama }}</td>
		                    <td>{{ $s->hp }}</td>
		                    <td>{{ $s->getDivisi->nama }}</td>
		                    <td>
		                        <a href="/admin/supplier/{{ $s->idsales }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
		                        {!! Form::open(['url' => '/admin/sales/' . $s->idsales, 'method' => 'DELETE']) !!}
		                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!}
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>
		        </table>
   			    <div class="pull-right">{!! $sales->render() !!}</div>
		    </div>
	 	</div>
	</div>
</div>
@endsection