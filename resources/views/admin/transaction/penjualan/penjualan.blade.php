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
    <li class="active"><i class="fa fa-users"></i>Penjualan</li>
</ol>
@endsection
 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <span><h1><i class="fa fa-user-secret"></i>Penjualan</h1></span>
                <a href="#asearch" class="btn btn-success">Advanced Search</a>
                <button id="reset" class="btn btn-warning">Reset Filter</button>
                <span id='asearch' style="display:none">
                    {!! Form::open(['url'=>'/admin/penjualan','method'=>'GET','class'=>'form-']) !!}
                    {!! Form::hidden('mode','adv') !!}
                    <div class="col-lg-12">
                            <div class="input-control">
                                <label class="control-label ">Range Tanggal</label>
                                <span  id="tgl"><a><i class="fa fa-calendar"></a></i>
                                    <span></span>
                                </span>
                                {!! Form::hidden('tgl1',\Request::input('tgl1')) !!}
                                {!! Form::hidden('tgl2',\Request::input('tgl2')) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Divisi</label>
                                {!! Form::select('divisi',$divisi,\Request::input('divisi'),['class'=>'form-control']) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Konsumen</label>
                                {!! Form::text('konsumen',\Request::input('konsumen'),['placeholder'=>'Nama Konsumen','class'=>'form-control']) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Sales</label>
                                {!! Form::select('sales',$sales,\Request::input('sales'),['class'=>'form-control']) !!}
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
                <table  id="tbjual" class="table display responsive">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID Penjualan</th>
                            <th>Tgl</th>
                            <th>Konsumen</th>
                            <th>Sales</th>
                            <th>Divisi</th>
                            <th>Payment</th>
                            <th>Tempo</th>
                            <th>Qty</th>
                            <th>Bruto</th>
                            <th>Disc</th>
                            <th>Netto</th>
                            <th>Keterangan</th>
                            <th>Kasir</th>
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
                            <td>{{ $j->kasir }}</td>

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
    var pdfTitle = '\nTgl: '+moment(getURLParameter('tgl1')).format('DD MMMM YYYY')+' s/d '+moment(getURLParameter('tgl2')).format('DD MMMM YYYY');

    var table = $('#tbjual').DataTable({
        dom: 'Bflrtip',
        order: [[1,'desc']],
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
                return moment(data).format('DD MMM YYYY');
            } },
            { responsivePriority: 2, targets: 3 },
            { responsivePriority: 2, targets: 4 },
            { responsivePriority: 2, targets: 5 },
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
                        data: $.makeArray(api.column(3,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 4,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        data: $.makeArray(api.column(4,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 5,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        data: $.makeArray(api.column(5,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 6,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        data: $.makeArray(api.column(6,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 12,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        data: $.makeArray(api.column(12,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 13,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_match_mode: 'contains',
                        data: $.makeArray(api.column(13,{filter:'applied'} ).data().sort().unique())
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
    $('#tgl span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
    $('input[name="tgl1"]').val(start.format('YYYY-MM-DD'));
    $('input[name="tgl2"]').val(end.format('YYYY-MM-DD'));
});

</script>
@endsection