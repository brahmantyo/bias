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
.text-right {
    text-align: right !important;
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
                <span><h1><i class="fa fa-user-secret"></i>Penjualan {{\App\Helpers::dateFromMysqlSystem(\Request::get('tgl1')).' s/d '.\App\Helpers::dateFromMysqlSystem(\Request::get('tgl2'))}}</h1></span>
                <a href="#asearch" class="btn btn-success">Advanced Search</a>
                <button id="reset" class="btn btn-warning">Reset Filter</button>
                <span id='asearch' style="display:none">
                    {!! Form::open(['url'=>'/admin/penjualan','method'=>'GET','class'=>'form-']) !!}
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
                @if(\Request::input('mode')=='adv')
                <div class="box box-default col-lg-12">
                    <span class="col-lg-2" id="fkonsumen"></span>
                    <span class="col-lg-2" id="fsales"></span>
                    <span class="col-lg-2" id="fdivisi"></span>
                    <span class="col-lg-2" id="fpayment"></span>
                    <span class="col-lg-2" id="fnota"></span>
                    <span class="col-lg-2" id="fkasir"></span>
                </div>

                </table>
                <table  id="tbjual" class="table display responsive" width="1000px">
                    <thead>
                        <tr>
                            <th width="8px"></th>
                            <th width="12px">ID Penjualan</th>
                            <th width="12px">Tgl<br/></th>
                            <th width="30px">Konsumen<br/></th>
                            <th width="20px">Sales<br/></th>
                            <th width="100px">Divisi<br/></th>
                            <th width="12px">Payment<br/></th>
                            <th width="8px">Tempo<br/></th>
                            <th width="12px">Qty</th>
                            <th width="12px">Bruto</th>
                            <th width="12px">Disc</th>
                            <th width="12px">Netto</th>
                            <th width="8px">Ket<br/></th>
                            <th width="12px">Kasir<br/></th>
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
                            <td class="text-right">{{ $j->totqty }}</td>
                            <td class="text-right">{{ $j->totbruto }}</td>
                            <td class="text-right">{{ $j->totdiskon }}</td>
                            <td class="text-right">{{ $j->totnetto }}</td>
                            <td>{{ $j->ket }}</td>
                            <td>{{ strtoupper($j->kasir) }}</td>

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
                            <th class="text-right"></th>
                            <th class="text-right"></th>
                            <th class="text-right"></th>
                            <th class="text-right"></th>
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

    function padspace(n, length) {    // fill with _
         
        n = ("_______________" + n).slice(-length);
        return n;
    }

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
                extend: 'csv',
                text: 'Save to CSV',
                title: 'Data Penjualan '+pdfTitle,
                exportOptions: {
                    columns: ':visible',
                    orthogonal: 'export',
                    modifier: {
                        filter: 'applied'
                    }
                }
            },
            {
                extend: 'excel',
                text: 'Save to Excel',
                title: 'Data Penjualan '+pdfTitle,
                exportOptions: {
                    columns: ':not(:first-child)',
                    orthogonal: 'export',
                    modifier: {
                        filter: 'applied'
                    },
                },
            },
            {
                extend: 'pdf',
                text: 'Save to PDF',
                title: 'Data Penjualan '+pdfTitle,
                orientation: 'landscape',
                header: true,
                footer: true,
                download: 'open',
                exportOptions: {
                    columns: [
                        ':visible:contains("ID Penjualan")',
                        ':visible:contains("Tgl")',
                        ':visible:contains("Konsumen")',
                        ':visible:contains("Sales")',
                        ':visible:contains("Divisi")',
                        ':visible:contains("Payment")',
                        ':visible:contains("Tempo")',
                        ':visible:contains("Qty")',
                        ':visible:contains("Bruto")',
                        ':visible:contains("Disc")',
                        ':visible:contains("Netto")',
                        ':visible:contains("Ket")',
                        ':visible:contains("Kasir")'
                    ],
                    modifier: {
                        filter: 'applied'
                    },
                },

            },
            {
                extend: 'print',
                exportOptions: {
                    orthogonal: true,
                    columns: [
                        ':visible:contains("ID Penjualan")',
                        ':visible:contains("Tgl")',
                        ':visible:contains("Konsumen")',
                        ':visible:contains("Sales")',
                        ':visible:contains("Divisi")',
                        ':visible:contains("Payment")',
                        ':visible:contains("Tempo")',
                        ':visible:contains("Qty")',
                        ':visible:contains("Bruto")',
                        ':visible:contains("Disc")',
                        ':visible:contains("Netto")',
                        ':visible:contains("Ket")',
                        ':visible:contains("Kasir")'
                    ],
                    modifier: {
                        filter: 'applied'
                    }
                }
            },
        ],
        responsive: false,
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
            { responsivePriority: 1,  targets: -3, render: $.fn.dataTable.render.number( '.', ',', 2, '' ) },
            { responsivePriority: 10, targets: -4, render: $.fn.dataTable.render.number( '.', ',', 2, '' ) },
            { responsivePriority: 10, targets: -5, render: $.fn.dataTable.render.number( '.', ',', 2, '' ) },
            { responsivePriority: 10, targets: -6, render: $.fn.dataTable.render.number( '.', ',', 2, '' ) },
        ],
        colReorder: true,
        drawCallback: function() {
            var api = this.api();
            $(api.table().column(8).footer()).html(
                $.fn.dataTable.render.number( '.', ',', 2, '' ).display(api.column(8,{filter:'applied'} ).data().sum())
            );
            $(api.table().column(9).footer()).html(
                $.fn.dataTable.render.number( '.', ',', 2, '' ).display(api.column(9,{filter:'applied'} ).data().sum())
            );     
            $(api.table().column(10).footer()).html(
                $.fn.dataTable.render.number( '.', ',', 2, '' ).display(api.column(10,{filter:'applied'} ).data().sum())
            );     
            $(api.table().column(11).footer()).html(
                $.fn.dataTable.render.number( '.', ',', 2, '' ).display(api.column(11,{filter:'applied'} ).data().sum())
            );

            yadcf.init(api.table(), 
                [
                    {
                        column_number: 3,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fkonsumen',
                        filter_default_label: '--Pilih Konsumen--',
                        //data: $.makeArray(api.column(3,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 4,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fsales',
                        filter_default_label: '--Pilih Sales--',
                        //data: $.makeArray(api.column(4,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 5,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fdivisi',
                        filter_default_label: '--Pilih Divisi--',
                        //data: $.makeArray(api.column(5,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 6,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fpayment',
                        filter_default_label: '--Pilih Payment--',
                        //data: $.makeArray(api.column(6,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 12,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fnota',
                        filter_default_label: '--Pilih Nota--',
                        filter_match_mode: 'exact',
                        //data: $.makeArray(api.column(12,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 13,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fkasir',
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

</script>
@endsection