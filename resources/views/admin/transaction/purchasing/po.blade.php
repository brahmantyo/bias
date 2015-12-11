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
                    {!! Form::open(['url'=>'/admin/purchasing','method'=>'GET','class'=>'form-']) !!}
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
                <div class="box box-default col-lg-12">
                    <span class="col-lg-3" id="fpo"></span>
                    <span class="col-lg-3" id="fsupplier"></span>
                    <span class="col-lg-3" id="fkontrak"></span>
                    <span class="col-lg-3" id="fdivisi"></span>
                    <span class="col-lg-3" id="fpayment"></span>
                    <span class="col-lg-3" id="fplu"></span>
                    <span class="col-lg-3" id="fket"></span>
                    <span class="col-lg-3" id="fadmin"></span>
                </div>
                <table  id="tbjual" class="table display responsive" width="100%">
                    <thead>
                        <tr>
                            <th width="8"></th>
                            <th width="12">ID PO</th>
                            <th width="12">Tgl<br/></th>
                            <th width="12">No.Kontrak</th>
                            <th width="30">Supplier<br/></th>
                            <th width="12">Divisi<br/></th>
                            <th width="12">Payment<br/></th>
                            <th width="8">Tempo<br/></th>
                            <th width="8">PLU</th>
                            <th >Barang</th>
                            <th width="12">Harga</th>
                            <th width="12">Qty</th>
                            <th width="20">Sub Total</th>
                            <th width="20">Total</th>
                            <th>Keterangan<br/></th>
                            <th width="12">DiEntry<br/></th>
                        </tr>
                    </thead>
         
                    <tbody>
                        <?php $idpo='';?>
                        @foreach ($po as $list)
                        <tr {!! ($idpo!==$list->idpo)?'style="border-top:3px black solid"':'' !!} >
                            <td>
                                <a href="/admin/purchasing/show/{{ str_replace('/','-',$list->idpo) }}" class="btn btn-success pull-right" style="margin-right: 3px;">Detail</a>
                            </td>
                            <td>{{ $list->idpo }}</td>
                            <td>{{ $list->tglpo }}</td>
                            <td>{{ $list->contractno }}</td>
                            <td>{{ $list->supplier }}</td>
                            <td>{{ $list->nmdivisi }}</td>
                            <td>{{ $list->bayar }}</td>
                            <td>{{ strtoupper($list->paymentterms) }}</td>
                            <td>{{ $list->plu }}</td>
                            <td>{{ $list->nmbarang }}</td>
                            <td style="text-align:right">{{ $list->hrg }}</td>
                            <td style="text-align:right">{{ $list->qty }}</td>
                            <td style="text-align:right">{{ $list->subtot }}</td>
                            <td style="text-align:right">{!! ($idpo!==$list->idpo)?$list->totporeg?$list->totporeg:$list->totpokhusus:'' !!}</td>
                            <td>{{ strtoupper($list->ket) }}</td>
                            <td>{{ strtoupper(ucfirst($list->createdby)) }}</td>
                        </tr>
                        <?php $idpo = $list->idpo ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background:lightgreen">
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
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
        //fitToView: true,
        minWidth: "80%",
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
                dowload: 'open',
                exportOptions: {
                    //columns: ':not(:first-child)',
                    columns: function(idx,data){
                        var col = table.columns().visible().toArray();
                        return col[idx];
                    },
                    modifier: {
                        filter: 'applied'
                    }
                }
            }
        ],
        responsive: false,
        columnDefs: [
            { targets: 0, orderable: false },
            { targets: 1 },
            { targets: 2, orderable: false, render: function(data){
                if(data){
                    return moment(data).format('DD/MM/YYYY');
                }
                return '';
            } },
            { targets: 3 , orderable: false, visible:false},
            { targets: 4, orderable: false, visible:false},
            { targets: 5, orderable: false, visible:false },
            { targets: 6, orderable: false, visible:false },
            { targets: 7, orderable: false, visible:false },
            { targets: 8, orderable: false},
            { targets: 9, orderable: false},
            { targets: 10, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 11, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 12, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 13, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
            { targets: 14, orderable: false, visible:false },
            { targets: 15, orderable: false, visible:false },
        ],
        colReorder: true,
        drawCallback: function() {
            var api = this.api();   
            $(api.table().column(11).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(11,{filter:'applied'} ).data().sum())
            );     
            $(api.table().column(12).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(12,{filter:'applied'} ).data().sum())
            );
            $(api.table().column(13).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(13,{filter:'applied'} ).data().sum())
            );

            yadcf.init(api.table(), 
                [
                    {
                        column_number: 1,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fpo',
                        filter_default_label: '--Pilih PO--',
                        //data: $.makeArray(api.column(3,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 3,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fkontrak',
                        filter_default_label: '--Pilih Kontrak--',
                        //data: $.makeArray(api.column(4,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 4,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fsupplier',
                        filter_default_label: '--Pilih Supplier--',
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
                        column_number: 7,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_container_id: 'fplu',
                        filter_default_label: '--Pilih PLU--',
                        //data: $.makeArray(api.column(12,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 14,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_match_mode: 'contains',
                        filter_container_id: 'fket',
                        filter_default_label: '--Pilih Keterangan--',
                        //data: $.makeArray(api.column(13,{filter:'applied'} ).data().sort().unique())
                    },
                    {
                        column_number: 15,
                        filter_type: 'multi_select',
                        select_type: 'chosen',
                        filter_match_mode: 'contains',
                        filter_container_id: 'fadmin',
                        filter_default_label: '--Pilih Admin--',
                        //data: $.makeArray(api.column(13,{filter:'applied'} ).data().sort().unique())
                    },
                ]);
        } 
    }).columns.adjust();
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