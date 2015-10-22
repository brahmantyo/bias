@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Master Pegawai</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-users"></i>Master Pegawai</h1></span>
		    	<hr>
				<span class="pull-right"><a class="btn btn-success	" id="tambah" href="/pegawai/create">Tambah</a></span>		    	
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
							<td width="10" style="">NO.PEGAWAI</td>
							<td>NAMA</td>
							<td>ALAMAT</td>
							<td>TGL REKRUT</td>
							<td>JABATAN</td>
							<td>GAJI POKOK</td>
							<td width="135"></td>
						</tr>
					</thead>
					<tbody>
						@foreach($pegawai as $list)
						<tr>
							<td>{{ $list->nopeg }}</td>
							<td>{{ $list->nama }}</td>
							<td>{{ $list->alamat }}</td>
							<td>{{ date_format(date_create($list->tglrekrut),'d-m-Y') }}</td>
							<td>{{ $list->jabatan }}</td>
							<td>{{ $list->gajipokok }}</td>
							<td>
								<a href="/pegawai/edit/{{ $list->nopeg }}">Edit</a>
								<a href="/pegawai/delete/{{ $list->nopeg }}">Delete</a>
							</td>
						</tr>
						@endforeach
					</tbody>
		        </table>
		        {!! $pegawai->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection