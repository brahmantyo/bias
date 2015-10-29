@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-users"></i>Supplier Management</li>
</ol>
@endsection
 
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-user-secret"></i>Supplier Management</h1></span>
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
		                    <th>Nama Supplier</th>
		                    <th>Alamat</th>
		                    <th>Nama Perusahaan</th>
		                    <th>Telp Perusahaan 1</th>
		                    <th>Telp Perusahaan 2</th>
		                    <th>Kontak Person</th>
		                    <th>Telp Kontak</th>
		                    <th width="130"></th>
		                </tr>
		            </thead>
		 
		            <tbody>
		                @foreach ($supplier as $s)
		                <tr>
		                    <td>{{ $s->idsupp }}</td>
		                    <td>{{ $s->nama }}</td>
		                    <td>{{ $s->alamat }}</td>
		                    <td>{{ $s->nmperusahaan }}</td>
		                    <td>{{ $s->telp1 }}</td>
		                    <td>{{ $s->telp2 }}</td>
		                    <td>{{ $s->cp }}</td>
		                    <td>{{ $s->cpphone }}</td>
		                    <td>
		                        <a href="/admin/supplier/{{ $s->idsupplier }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
		                        {!! Form::open(['url' => '/admin/supplier/' . $s->idsupp, 'method' => 'DELETE']) !!}
		                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!}
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>
		        </table>
   			    <div class="pull-right">{!! $supplier->render() !!}</div>
		    </div>
	 	</div>
	</div>
</div>
@endsection