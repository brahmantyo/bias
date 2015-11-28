@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Monitoring PO</li>
</ol>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-share-alt"></i>Monitoring Purchase Order</h1></span>
				<span class="pull-left">
					<div class="col-sm-4">
						{!! Form::open(['url'=>'/admin/monitoringpo/date','method'=>'GET','class'=>'form-inline']) !!}
						<div class="form-group">
							<div class="input-group">
								{!! Form::text('date',old('date'),['class'=>'form-control input-group-addon ']) !!}
								<span class="input-group-btn">
									{!! Form::submit('Search By Day',['class'=>'btn btn-success']) !!}
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
						<tr style="font-weight: bold;text-align:center">
							<td rowspan="2">YEAR</td>
							<td rowspan="2">MONTH</td>
							<td rowspan="2">TARGET</td>
							<td colspan="3">PO</td>
							<td colspan="3">REALISASI</td>
							<td rowspan="2">SALDO BUDGET</td>
						</tr>
						<tr style="font-weight: bold; text-align:center">
							<td>PO STOCK</td>
							<td>PO KHUSUS</td>
							<td>TOTAL</td>
							<td>PO STOCK</td>
							<td>PO KHUSUS</td>
							<td>TOTAL</td>
						</tr>
					</thead>
   		        	<tbody>
   		        		@foreach($mpo as $l)
   		        		<tr>
   		        			<td>{{ $l->tahun }}</td>
   		        			<td>{{ \App\Helpers::month($l->bulan,'l') }}</td>
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->vtarget) }}</td>
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->tporeg) }}</td>
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->tpokhusus) }}</td>
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->tporeg + $l->tpokhusus) }}</td>   		        			
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->trealreg) }}</td>
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->trealkhusus) }}</td>
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->trealreg + $l->trealkhusus) }}</td>
   		        			<td style="text-align:right">{{ \App\Helpers::currency($l->vtarget - ($l->trealreg + $l->trealkhusus)) }}</td>
   		        		</tr>
   		        		@endforeach
   		        	</tbody>
		        </table>
		    </div>
	 	</div>
	</div>
</div>
@endsection