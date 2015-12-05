@extends('app')

@section('search-form')
        <!-- search form -->
        <form action="" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" id="q" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
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

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-users"></i>Purchase Order</li>
</ol>
@endsection
 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <span><h1><i class="fa fa-user-secret"></i>Purchase Order</h1></span>
                <a href="#asearch" class="btn btn-success">Advanced Search</a>
                <button id="reset" class="btn btn-warning">Reset Filter</button>
                <span id='asearch' style="display:none">
                    {!! Form::open(['url'=>'/admin/purchasing/po','method'=>'GET','class'=>'form-']) !!}
                    {!! Form::hidden('mode','adv') !!}
                    <div class="col-lg-12">
                            <div class="input-control">
                                <label class="control-label ">Range Tanggal</label>
                                <span  id="tgl"><a><i class="fa fa-calendar"></a></i>
                                    <span class="badge badge-default">{{\Request::input('tgl1').'s/d'.\Request::input('tgl2')}}</span>
                                </span>
                                {!! Form::hidden('tgl1',\Request::input('tgl1')) !!}
                                {!! Form::hidden('tgl2',\Request::input('tgl2')) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Divisi</label>
                                {!! Form::select('divisi',$divisi,\Request::input('divisi'),['class'=>'form-control']) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Supplier/Pabrik</label>
                                {!! Form::text('supplier',\Request::input('supplier'),['placeholder'=>'Nama Supplier/Pabrik','class'=>'form-control']) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Kontrak</label>
                                {!! Form::text('kontrak',\Request::input('kontrak'),['placeholder'=>'Nomer Kontrak','class'=>'form-control']) !!}
                            </div>
                    </div>
                    {!! Form::submit('Search',['class'=>'btn btn-success']) !!}
                    {!! Form::close() !!}
                </span>
            </div>

            <div class="box-body table-responsive" width="100%">
                @if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif
                @if(\Request::input('mode')=='adv')
                <table  id="tbjual" class="table display responsive">
                    <thead>
                        <tr>
                            <th width="8"></th>
                            <th width="12">ID Penjualan</th>
                            <th width="12">Tgl<br/></th>
                            <th width="30">Konsumen<br/></th>
                            <th width="12">Sales<br/></th>
                            <th width="12">Divisi<br/></th>
                            <th width="12">Payment<br/></th>
                            <th width="8">Tempo<br/></th>
                            <th width="12">Qty</th>
                            <th width="12">Bruto</th>
                            <th width="12">Disc</th>
                            <th width="12">Netto</th>
                            <th>Keterangan<br/></th>
                            <th width="12">Kasir<br/></th>
                        </tr>
                    </thead>
         
                    <tbody>
                        @foreach ($jual as $j)
                        <tr>
                            <td>
                                <a href="/admin/penjualan/show/{{ $j->idtrx }}" class="btn btn-success pull-right" style="margin-right: 3px;">Detail</a>
                            </td> 
                            <td>{{ $j->idtrx }}</td>
                            <td>{{ $j->tgl }}</td>
                            <td>{{ $j->konsumen->nama }}</td>
                            <td>{{ $j->sales->nama }}</td>
                            <td>{{ $j->sales->divisi()->nama }}</td>
                            <td>{{ $j->payment }}</td>
                            <td>{{ $j->tempo }}</td>
                            <td style="text-align:right">{{ $j->totqty }}</td>
                            <td style="text-align:right">{{ $j->totbruto }}</td>
                            <td style="text-align:right">{{ $j->totdiskon }}</td>
                            <td style="text-align:right">{{ $j->totnetto }}</td>
                            <td>{{ $j->ket }}</td>
                            <td>{{ ucfirst($j->kasir) }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="text-align:right"></th>
                            <th style="text-align:right"></th>
                            <th style="text-align:right"></th>
                            <th style="text-align:right"></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('a:contains("Detail")').fancybox({
        type : 'iframe',
        href : this.value,
        fitToView: true,
        minWidth: "80%",
//        width: 1024,
//        height: 800,
        openSpeed: 1,
        closeSpeed: 1,
        ajax : {
            dataType : 'html',
        },
        //afterClose : function(){ window.location.replace('/admin/penjualan') },
    });
    $('a:contains("Advanced Search")').fancybox({
        href : this.value,
        fitToView: true,
        minWidth: "80%",
        minHeight: "90%",
        openSpeed: 1,
        closeSpeed: 1,
    });

    function getURLParameter(name) {
      return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
    }
    var curTgl = moment(getURLParameter('tgl1')).format('DD MMMM YYYY')+' s/d '+moment(getURLParameter('tgl2')).format('DD MMMM YYYY');
    var pdfTitle = '\nTgl: '+curTgl;

    var table = $('#tbjual').DataTable({
        dom: 'Bflrtip',
        order: [[2,'desc']],
        select: true,
        buttons: [
            {
                extend: 'colvis',
                columns: ':not(:first-child)',
                text: 'Show/Hide Columns',
            },
            {
                extend: 'excel',
                text: 'Save to Excel',
                title: 'Data Penjualan '+pdfTitle,
                exportOptions: {
                    columns: ':not(:first-child)',
                }
            },
            {
                extend: 'pdf',
                text: 'Save to PDF',
                title: 'Data Penjualan '+pdfTitle,
                orientation: 'landscape',
                header: true,
                footer: true,
                exportOptions: {
                    columns: ':not(:first-child)',
                    modifier: {
                        filter: 'applied'
                    }
                }
            }
        ],
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0, orderable: false },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 1, targets: 2, render: function(data){
                return moment(data).format('DD/MM/YYYY');
            } },
            { responsivePriority: 2, targets: 3 },
            { responsivePriority: 2, targets: 4 },
            { responsivePriority: 2, targets: 5 },
            { responsivePriority: 2, targets: -1 },
            { responsivePriority: 2, targets: -2 },
            { responsivePriority: 1,  targets: -3, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { responsivePriority: 10, targets: -4, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { responsivePriority: 10, targets: -5, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { responsivePriority: 10, targets: -6, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
        ],
        colReorder: true,
        drawCallback: function() {
            var api = this.api();
            $(api.table().column(8).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(8,{filter:'applied'} ).data().sum())
            );
            $(api.table().column(9).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(9,{filter:'applied'} ).data().sum())
            );     
            $(api.table().column(10).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(10,{filter:'applied'} ).data().sum())
            );     
            $(api.table().column(11).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(11,{filter:'applied'} ).data().sum())
            );


            yadcf.init(api.table(), 
                [
                    {
                        column_number: 3,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_default_label: '--Pilih Konsumen--',
                        filter_reset_button_text: false
                        //data: $.makeArray(api.column(3,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 4,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_default_label: '--Pilih Sales--',
                        //data: $.makeArray(api.column(4,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 5,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_default_label: '--Pilih Divisi--',
                        //data: $.makeArray(api.column(5,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 6,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_default_label: '--Pilih Payment--',
                        //data: $.makeArray(api.column(6,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 12,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_default_label: '--Pilih Nota--',
                        //data: $.makeArray(api.column(12,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 13,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_match_mode: 'contains',
                        filter_default_label: '--Pilih Kasir--',
                        //data: $.makeArray(api.column(13,{filter:'applied'} ).data().sort().unique())
                    },
                ]);
        } 
    }).columns.adjust().responsive.recalc();
$('#reset').on('click',function(){
    table
 .search( '' )
 .columns().search( '' )
 .draw();
});

$('#tgl').daterangepicker(
{
    'startDate': '09/01/2015',
    'endDate': '12/31/2015',
    'opens': 'center'
}, 
function(start, end, label) {
    $('#tgl span').html(start.format('D MMMM YYYY') + ' s/d ' + end.format('D MMMM YYYY'));
    $('input[name="tgl1"]').val(start.format('YYYY-MM-DD'));
    $('input[name="tgl2"]').val(end.format('YYYY-MM-DD'));
});

$('#tgl span').html(curTgl);

$(window).on( 'resize', function () {
    //table.fnAdjustColumnSizing();
} );
$('#tbjual').on( 'column-visibility.dt', function ( e, settings, column, state ) {
    console.log(
        'Column '+ column +' has changed to '+ (state ? 'visible' : 'hidden')
    );
} );
</script>
@endsection