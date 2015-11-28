@extends('app-modal')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-share-alt"></i>Monitoring Stock [PLU]</h1></span>
				<span class="pull-left">
					<div class="col-sm-4">
						{!! Form::open(['url'=>'/admin/monitoringpo/date','method'=>'GET','class'=>'form-inline']) !!}
<!-- 						<div class="form-group">
							<div class="input-group">
								{!! Form::text('date',old('date'),['class'=>'form-control input-group-addon ']) !!}
								<span class="input-group-btn">
									{!! Form::submit('Search By Day',['class'=>'btn btn-success']) !!}
								</span>
							</div>
						</div> -->
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

   		        	</tbody>
   		        	<tfoot>
   		        		<tr>
   		        		</tr>
   		        	</tfoot>
		        </table>
		    </div>
	 	</div>
	</div>
</div>
@endsection