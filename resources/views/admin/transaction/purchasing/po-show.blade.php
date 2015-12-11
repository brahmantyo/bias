@extends('app-modal')

@section('head')

<link href="{{ asset('/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css" />    

 
<script src="{{ asset('/plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('/plugins/DataTables/Plugins/sum.js') }}"></script>

@endsection

@section('content-header')
<h1>
User Manager
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/po"><i class="fa fa-dashboard"></i>Purchase Order</a></li>
    <li class="active">Detail</li>
</ol>
@endsection

@section('content')
 
<div class='col-lg-10 col-lg-offset-1'>
 
    <h1><i class='fa fa-user'></i>PO Detail</h1>
 
    <div class="well col-lg-12">
        <div class="col-lg-12">
            <table height="100%" class="table table-condensed table-striped table-bordered no-margin">
                <tr>
                    <td width="100px">ID PO</td><td> : {{ $po->idpo }}</td>
                    <td width="100px">Mata Uang</td><td> : {{ $po->matauang }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td><td> : {{ $po->tglpo }}</td>
                    <td>Cara Bayar</td><td> : {{ $po->bayar }}</td>
                </tr>
                <tr>
                    <td>Supplier</td><td> : {{ $po->supp->nama }}</td>
                    <td>Term. Bayar</td><td> : {{ $po->paymentterms }}</td>
                </tr>
                <tr>
<!--                     <td>Status</td><td> : {{ $po->status }}</td> -->
                    <td>No.Kontrak</td><td> : {{ $po->contractno }}</td>
                    <td>Keterangan</td><td> : {{ $po->ket }}</td>
                </tr>
                <tr>
                </tr>
            </table>
            <table  id='tbdetail' class="table table-condensed table-striped table-bordered table-hover no-margin">
                <thead>
                    <tr>
                        <th>PLU</th>
                        <th>Nama Barang</th>
                        <th>Harga/Qty</th>
                        <th>Qty</th>
                        <th>Sub.Total</th>
                        <th>Perkiraan Selesai</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($po->detail as $dpo)
                    <tr>
                        <td>{{$dpo->plu}}</td>
                        <td>{{$dpo->barang->namadet}}</td>
                        <td style="text-align:right">{{$dpo->hrg}}</td>
                        <td style="text-align:right">{{$dpo->qty}}</td>
                        <td style="text-align:right">{{$dpo->qty * $dpo->hrg}}</td>
                        <td>{{$dpo->est_delivery}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th style="text-align:right"></th>
                        <th style="text-align:right"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
<script type="text/javascript">
var table = $('#tbdetail').DataTable({
    dom: 'ftp',
    columnDefs:[
        { targets: 2, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
        { targets: 3, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
        { targets: 4, orderable: false, render: $.fn.dataTable.render.number( '.', ',', 0, '' ) },
    ],
    drawCallback: function() {
        var api = this.api();   
        $(api.table().column(3).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(3,{filter:'applied'} ).data().sum())
        );
        $(api.table().column(4).footer()).html(
            $.fn.dataTable.render.number( '.', ',', 0, '' ).display(api.column(4,{filter:'applied'} ).data().sum())
        );
    }
});
</script>
@endsection