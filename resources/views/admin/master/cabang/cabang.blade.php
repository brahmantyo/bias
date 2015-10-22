@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Master Cabang</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-share-alt"></i>Master Cabang</h1></span>
		    	<hr>
				<span class="pull-right"><a class="btn btn-success	" id="tambah" href="/cabang/create">Tambah</a></span>		    	
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
							<td>NAMA CABANG</td>
							<td>ALAMAT</td>
							<td>TELP</td>
							<td width="135"></td>
						</tr>
					</thead>
					<tbody>
						@foreach($cabang as $list)
						<tr>
							<td>{{ $list->nama }}</td>
							<td>{{ $list->alamat }}</td>
							<td>{{ $list->telp }}</td>
							<td>
								<a class="btn btn-info" href="/cabang/edit/{{$list->idcabang}}">Edit</a>
								<a class="btn btn-warning" href="/cabang/delete/{{$list->idcabang}}">Hapus</a>
							</td>
						</tr>
						@endforeach
					</tbody>
		        </table>
   		        {!! $cabang->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection