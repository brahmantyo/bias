@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Stock</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-share-alt"></i>Monitoring Stock</h1></span>
    	<span>
					{!! Form::open(['url'=>'/admin/report/stock','method'=>'GET','class'=>'form-horizontal']) !!}
					<div class="col-lg-12">
						<div class="form-group">
							<div class="input-group">
								{!! Form::text('s',old('s'),['placeholder'=>'Search everything here ...','class'=>'form-control input-group-addon ']) !!}
								<span class="input-group-btn">
									{!! Form::submit('Search',['class'=>'btn btn-success']) !!}
								</span>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
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
						<tr style="font-weight: bold;text-align:center">
							<td rowspan="2">SUPPLIER</td>
							<td rowspan="2">PLU</td>
							<td rowspan="2">NAMA BARANG</td>
							<td colspan="2">UNIT</td>
							<td colspan="2">PANJANG</td>
							<td colspan="2">BERAT</td>
							<td rowspan="2"></td>
						</tr>
						<tr style="font-weight: bold; text-align:center">
							<td>QTY</td>
							<td>SATUAN</td>
							<td>QTY</td>
							<td>SATUAN</td>
							<td>QTY</td>
							<td>SATUAN</td>
						</tr>
					</thead>
   		        	<tbody>
   		        		@foreach($stock as $s)
   		        		<tr>
   		        			<td>{{ $s->supplier }}</td>
   		        			<td>{{ $s->plu }}</td>
   		        			<td>{{ $s->nmbarang }}</td>
   		        			<td style="text-align:right">{{ $s->qtyunit }}</td>
   		        			<td>{{ $s->satunit }}</td>
   		        			<td style="text-align:right">{{ $s->qtypjg }}</td>
   		        			<td>{{ $s->satpjg }}</td>
   		        			<td style="text-align:right">{{ $s->qtybrt }}</td>
   		        			<td>{{ $s->satbrt }}</td>
   		        			<td>
		                        <a id="detail" href="/admin/report/stock/show/{{ $s->plu }}" class="btn btn-success pull-right" style="margin-right: 3px;">Detail</a>
   		        			</td>
   		        		</tr>
   		        		@endforeach
   		        	</tbody>
   		        	<tfoot>
   		        		<tr>
   		        			<td colspan="9">{!! $stock->appends('s',old('s'))->render() !!}</td>
   		        		</tr>
   		        	</tfoot>
		        </table>
		    </div>
	 	</div>
	</div>
</div>
@endsection