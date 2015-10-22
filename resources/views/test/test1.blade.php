@extends('app')

@section('style')
    <link href="{{ asset('/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/datatables/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('script')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables-1.10.6.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>

@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Daftar Order Trucking</li>
</ol>
@endsection


@section('content')
<style type="text/css">
    td.details-control {
        background: url('/plugins/datatables/images/plus.jpg') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('/plugins/datatables/images/minus.jpg') no-repeat center center;
    }
</style>
<script type="text/javascript">/* Formatting function for row details - modify as you need */
$(document).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    /* Formatting function for row details - modify as you need */
    var table = $('#example').DataTable({
        "ajax": "/loadrute/SJT.1.9.150824.01",
        //"aaData": '{"data":[{"sjt":"SJT.1.9.150824.01","id":"1","kotamuat":"1","kotabongkar":"4","tglbrkt":"2015-08-22","tgltiba":null,"nilaimuatan":"0.00","totresi":"0","status":"0"},{"sjt":"SJT.1.9.150824.01","id":"2","kotamuat":"1","kotabongkar":"2","tglbrkt":"2015-08-22","tgltiba":null,"nilaimuatan":"0.00","totresi":"0","status":"0"},{"sjt":"SJT.1.9.150827.01","id":"1","kotamuat":"1","kotabongkar":"4","tglbrkt":"2015-08-25","tgltiba":null,"nilaimuatan":"0.00","totresi":"0","status":"0"}]}',
        "columnDefs": [
            { "visible": false, "targets": 1 },
            { "visible": false, "targets": 2 }
        ],
        "order": [[1,"desc"],[2,"asc"]],
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "sjt" },
            { "data": "id" },
            { "data": "cabasal" },
            { "data": "cabtujuan"},
            { "data": "tglbrkt"},
            { "data": "tgltiba"},
            { "data": "nilaimuatan"},
            { "data": "totresi"},
        ],
        "displayLength": 10,
    });
    
    // Add event listener for opening and closing details
    $('#btnExpand').on('click',function () {
        table.rows().every(function(i){
            var tr = $(this.node());
            var tdctrl = tr.find('td:first-child');
            tdctrl.click();
        });
    });

    $('#btnCollapse').on('click',function () {
        table.rows().every(function(i){          
            var tr = $(this.node());
            var row = table.row(tr);

            if(row.child.isShown()){
                this.child.hide();
                tr.removeClass('shown');
            }
        });
    });
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            $.ajax({
                  type: 'POST',
                  url: '/loadresi',
                  data: {'sjt':row.data().sjt,'idrute':row.data().id},
                  dataType: 'html',
                  ready: $('.detail').dataTable(),
                  success: function(jsonData) {
                    row.child( jsonData ).show();
                    tr.addClass('shown');
                  },
                  error: function() {
                    //alert('Error loading PatientID=' + id);
                  }
            });
        }
    });
});
</script>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-credit-card'></i>Daftar Order Trucking</h1>

            </div>
            <div class="box-body">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
            <div class="box-body">
                <button id="btnExpand">Buka semua</button>
                <button id="btnCollapse">Tutup semua</button>
<table id="example" class="display table-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>SJT</th>
            <th>IDRute</th>
            <th>Cab Asal</th>
            <th>Cab Tujuan </th>
            <th>Tgl.Brkt</th>
            <th>Tgl.Tiba</th>
            <th>Nilai Muatan</th>
            <th>Jml Resi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>SJT</th>
            <th>IDRute</th>
            <th>Cab Asal</th>
            <th>Cab Tujuan </th>
            <th>Tgl.Brkt</th>
            <th>Tgl.Tiba</th>
            <th>Nilai Muatan</th>
            <th>Jml Resi</th>
        </tr>
    </tfoot>
</table>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection