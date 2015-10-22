@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Article</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-pencil-square-o "></i>Article</h1></span>
		    	<hr>
				<span class="pull-right"><a class="btn btn-success	" id="tambah" href="/article/create">Tambah</a></span>		    	
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
							<td style="width:10px">NO</td>
							<td style="width:50px">JENIS</td>
							<td>JUDUL</td>
							<td style="width:100px">USER</td>
							<td width="135"></td>
						</tr>
					</thead>
					<tbody>
						@foreach($article as $list)
						<tr>
							<td>{{ $list->id }}</td>
							<td>
								<?php
									switch($list->type){
										case 'about':
											echo "About";
											break;
										case 'news' :
											echo "Berita";
											break;
										case 'memo' :
											echo "Catatan";
											break;
									}
								?>
							</td>
							<td>{{ $list->title }}</td>
							<td>{{ $list->name }}</td>
							<td>
								<a class="btn btn-info pull-left" href="/article/{{ $list->id }}/edit">Edit</a>
		                        {!! Form::open(['url' => '/article/' . $list->id, 'method' => 'DELETE']) !!}
		                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!}								
							</td>
						</tr>
						@endforeach
					</tbody>
		        </table>
   		        {!! $article->render() !!}
		    </div>
	 	</div>
	</div>
</div>
@endsection