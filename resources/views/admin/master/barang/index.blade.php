@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Master Barang</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-share-alt"></i>Master Barang</h1></span>
<!-- 				<span class="pull-right"><a class="btn btn-success" id="tambah" href="/admin/barang/create">Tambah</a></span>		    	 -->

				<span class="pull-left">
					<div class="col-sm-4 col-xs-12">
						{!! Form::open(['url'=>'/admin/barang/daftar','method'=>'GET','class'=>'form-inline']) !!}
						<div class="form-group">
							<div class="input-group">
								{!! Form::text('plu',old('plu'),['class'=>'form-control input-group-addon ']) !!}
								<span class="input-group-btn">
									{!! Form::submit('PLU',['class'=>'btn btn-success']) !!}
								</span>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
					<div class="col-sm-4 col-xs-12">
						{!! Form::open(['url'=>'/admin/barang/daftar','method'=>'GET','class'=>'form-inline']) !!}
						<div class="form-group">
							<div class="input-group">
								{!! Form::text('nama',old('nama'),['class'=>'form-control input-group-addon']) !!}
								<span class="input-group-btn">
								{!! Form::submit('Nama Barang',['class'=>'btn btn-success']) !!}
								</span>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
					<div class="col-sm-4 col-xs-12">
						{!! Form::open(['url'=>'/admin/barang/daftar','method'=>'GET','class'=>'form-inline']) !!}
						<div class="form-group">
							<div class="input-group">
								{!! Form::select('divisi',array_merge([0 => '--'],array_pluck($divisi,'nama','iddivisi')),old('divisi'),['class'=>'form-control input-group-addon']) !!}
								<span class="input-group-btn">
									{!! Form::submit('Divisi',['class'=>'btn btn-success']) !!}
								</span>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
				</span>
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
							<td>PLU</td>
							<td>NAMA BARANG</td>
							<td>DIVISI</td>
<!-- 							<td width="200"></td> -->
						</tr>
					</thead>
					<tbody>
						@foreach($barang as $b)
						<tr>
							<td>{{ $b->plu }}</td>
							<td>{{ $b->namadet }}</td>
							<td>{{ $b->divisi }}</td>
<!-- 							<td>
								<a class="btn btn-info pull-left" href="/admin/barang/{{$b->plu}}/edit" style="margin-right: 3px;">Edit</a>
						        {!! Form::open(['url' => '/admin/barang/' . $b->plu, 'method' => 'DELETE']) !!}
	                        	{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!}
							</td> -->
						</tr>
						@endforeach
					</tbody>
		        </table>
   		        {!! $barang->appends('plu',old('plu'))->appends('nama',old('nama'))->appends('divisi',old('divisi'))->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection