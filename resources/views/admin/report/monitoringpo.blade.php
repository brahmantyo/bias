@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Monitoring PO</li>
</ol>
@endsection

@section('head')
<link href="{{ asset('/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css" />    
<link href="{{ asset('/plugins/daterangepicker2/daterangepicker.css') }}" rel="stylesheet" type="text/css"  />
<link href="{{ asset('/plugins/DataTables/Plugins/yadcf/jquery.dataTables.yadcf.css') }}" rel="stylesheet" type="text/css"  />
<link href="{{ asset('/plugins/DataTables/Plugins/yadcf/chosen.bootstrap.css') }}" rel="stylesheet" type="text/css"  />

 
<script src="{{ asset('/plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/moment.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/daterangepicker.js') }}"></script>
<script src="{{ asset('/plugins/DataTables/Plugins/sum.js') }}"></script>

<script src="{{ asset('/plugins/DataTables/Plugins/yadcf/jquery.dataTables.yadcf.js') }}"></script>
<script src="{{ asset('/plugins/DataTables/Plugins/yadcf/jquery.chosen.js') }}"></script>


<style type="text/css">
ol.breadcrumb {
    margin-bottom: 0px !important;
}
.daterangepicker {
    z-index: 9030 !important;
}
.datatables-dropdownmenu {

}
</style>
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
		        <table style="table-layout:fixed" id="tbmonitoringpo" class="table display responsive">
		        	<colgroup>
						<col width="120px"></col>
						<col width="90px"></col>
						<col width="100px"></col>
						<col width="200px"></col>
						<col width="45px"></col>
						<col width="90px"></col>
						<col width="90px"></col>
						<col width="60px"></col>
						<col width="120px"></col>
						<col width="90px"></col>
						<col width="60px"></col>
						<col width="120px"></col>
						<col width="80px"></col>
						<col width="90px" align="right"></col>
						<col width="60px"></col>
						<col width="120px"></col>
						<col style="width:150px"></col>		        		
		        	</colgroup>
					<thead>
						<tr style="font-weight: bold;text-align:center">
	
							<th colspan="6"></th>
							<th colspan="3" style="background:#7b6778">RENCANA</th>
							<th colspan="4" style="background:#ae9aab">REALISASI</th>
							<th colspan="3" style="background:#7b6778">SELISIH</th>
							<th></th>
						</tr>
						<tr style="font-weight: bold; text-align:center">
							<th>ID.PO</th>
							<th>TGL.PO</th>
							<th>PLU</th>
							<th>NAMA ITEM</th>
							<th>CUR</th>
							<th>HARGA</th>
							<th style="background:#7b6778">QTY</th>
							<th style="background:#7b6778">SAT</th>
							<th style="background:#7b6778">NILAI</th>
							<th style="background:#bfabbc">QTY</th>
							<th style="background:#bfabbc">SAT</th>
							<th style="background:#bfabbc">NILAI</th>
							<th style="background:#bfabbc">&nbsp;</th>
							<th style="background:#7b6778">QTY</th>
							<th style="background:#7b6778">SAT</th>
							<th style="background:#7b6778">NILAI</th>
							<th></th>
						</tr>
					</thead>
					<tfoot>
						<tr style="font-weight: bold; text-align:center;border-top:3px black solid">
							<th style="background:#bfabbc" colspan="6">Total</th>
							<th style="background:#8c7889"></th>
							<th style="background:#8c7889"></th>
							<th style="background:#8c7889"></th>
							<th style="background:#bfabbc"></th>
							<th style="background:#bfabbc"></th>
							<th style="background:#bfabbc"></th>
							<th style="background:#bfabbc"></th>
							<th style="background:#8c7889"></th>
							<th style="background:#8c7889"></th>
							<th style="background:#8c7889"></th>
							<th></th>
						</tr>						
					</tfoot>
   		        	<tbody>
                    <?php $idpo='';?>
   		        	@foreach($po as $m)
   		        		<tr {!! ($idpo!==$m->idpo)?'style="border-top:3px black solid"':'' !!}>
   		        			<td>{{ $m->idpo }}</td>
   		        			<td>{{ $m->tglpo }}</td>
   		        			<td>{{ $m->plu }}</td>
   		        			<td>{{ $m->nmbarang }}</td>
   		        			<td>{{ $m->nn }}</td>
   		        			<td>{{ $m->hrg }}</td>
   		        			<td style="background:#cfbccd">{{ round($m->qty,2) }}</td>
   		        			<td style="background:#cfbccd">{{ $m->qty?$m->satbeli:'' }}</td>
   		        			<td style="background:#cfbccd">{{ round($m->valpo,2) }}</td>
   		        			<td style="background:#ae9aab">{{ round($m->qtybeli,2) }}</td>
   		        			<td style="background:#ae9aab">{{ $m->qtybeli?$m->satbeli:'' }}</td>
   		        			<td style="background:#ae9aab">{{ round(($m->qtybeli?$m->valbeli:0),2) }}</td>
   		        			<td style="background:#ae9aab">
   		        				<a href="/admin/report/pembelian/show/{{ str_replace('/','-',$m->idpo) }}" class="btn btn-small btn-success">
   		        				Detail
   		        				</a>
   		        			</td>
   		        			<td style="background:#cfbccd">{{ round($m->qty - $m->qtybeli,2) }}</td>
   		        			<td style="background:#cfbccd">{{ $m->qtybeli?$m->satbeli:'' }}</td>
   		        			<td style="background:#cfbccd">{{ round(($m->valpo-$m->valbeli),2) }}</td>
   		        			<td>
   		        				<?php
   		        					$p = ($m->qtybeli/$m->qty)*100;
   		        					$pval = round($p,2);
   		        					$psize = $p;
   		        					$pcolor = 'default';
   		        					$striped = 'progress-bar-striped';
   		        					if($p<30){
   		        						$pcolor="danger";
   		        					}else if($p>=100 && $p<=110){
   		        						$striped='';
   		        						$psize=100;
   		        						$pcolor="success";
   		        					}else if($p>110){
   		        						$striped='';
   		        						$psize=100;
   		        						$pcolor="warning";
   		        					}
   		        				?>
   		        				<div class="progress">
   		        					<div class="progress-bar {{ $striped }} progress-bar-{{ $pcolor }}" style="width:{{ $psize }}%;">{{ $pval }}%</div>
   		        				</div>
   		        			</td>
   		        		</tr>
                        <?php $idpo = $m->idpo ?>
   		        	@endforeach
   		        	</tbody>
		        </table>
		    </div>
	 	</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function() {
	$('#tbmonitoringpo').DataTable({
		responsive: false,
		columnDefs:[
            { targets: 0, orderable: true},
		    { targets: 1, orderable: false, render: function(data){
                if(data){
                    return moment(data).format('DD/MM/YYYY');
                }
                return '';
            } },
            { targets: 2, orderable: false},
            { targets: 3, orderable: false},
            { targets: 4, orderable: false},
            { targets: 5, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 6, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 7, orderable: false},
            { targets: 8, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 9, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 10, orderable: false},
            { targets: 11, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 12, orderable: false},
            { targets: 13, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 14, orderable: false},
            { targets: 15, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 6, orderable: false},
		],
	    drawCallback: function() {
	        var api = this.api();   
	        $(api.table().column(6).footer()).html(
	        $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(6,{filter:'applied'} ).data().sum())
	        );     
	        $(api.table().column(8).footer()).html(
	        $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(8,{filter:'applied'} ).data().sum())
	        );
	        $(api.table().column(9).footer()).html(
	        $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(9,{filter:'applied'} ).data().sum())
	        );
	        $(api.table().column(11).footer()).html(
	        $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(11,{filter:'applied'} ).data().sum())
	        );
	        $(api.table().column(13).footer()).html(
	        $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(13,{filter:'applied'} ).data().sum())
	        );
	        $(api.table().column(15).footer()).html(
	        $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(15,{filter:'applied'} ).data().sum())
	        );
	    },
	});
	},0);

    $('a:contains("Detail")').fancybox({
        type : 'iframe',
        href : this.value,
        //fitToView: true,
        minWidth: "90%",
        minHeight: "90%",
//        width: 1024,
//        height: 800,
        openSpeed: 1,
        closeSpeed: 1,
        ajax : {
            dataType : 'html',
        },
        //afterClose : function(){ window.location.replace('/admin/penjualan') },
    });
});
</script>
@endsection