@extends('app-modal')

@section('content-header')
<h1>
User Manager
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/pembelian"><i class="fa fa-dashboard"></i>Penjualan</a></li>
    <li class="active">Detail</li>
</ol>
@endsection

@section('head')

<link href="{{ asset('/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css" />    

<script src="{{ asset('/plugins/DataTables/datatables.min.js') }}"></script>

<script src="{{ asset('/plugins/DataTables/Plugins/sum.js') }}"></script>

<script src="{{ asset('/plugins/daterangepicker2/moment.js') }}"></script>

@endsection

@section('content')
 
<div class='col-lg-10 col-lg-offset-1'>
 
<!--     <h1><i class='fa fa-user'></i>Penjualan Detail</h1>
 --> 
    <div class="well col-lg-12">
        <div class="col-lg-12">
            <table height="100%" class="table table-condensed table-striped table-bordered no-margin">
                <tr><td>ID Penjualan</td><td> : {{ $jual->idtrx }}</td><td>Pembayaran</td><td> : {{ $jual->payment }}</td></tr>
                <tr><td>Tanggal</td><td> : {{ $jual->tgl }}</td><td>Jatuh Tempo</td><td> : {{ $jual->tempo }}</td></tr>
                <tr><td>Cabang</td><td> : {{ $jual->idcab }}</td><td>Keterangan Nota</td><td> : {{ $jual->ket }}</td></tr>
                <tr><td>Konsumen</td><td> : {{ $jual->konsumen->nama }}</td><td>Entry oleh</td><td> : {{ $jual->kasir }}</td></tr>
                <tr><td>Sales</td><td> : {{ $jual->sales->nama }}</td><td>Status</td><td> : {{ $jual->status }}</td></tr>
                <tr><td>Divisi</td><td> : {{ $jual->sales->div->nama }}</td></tr>
            </table>
            <table  id="tbdetail" class="table table-condensed table-striped table-bordered table-hover no-margin">
                <thead>
                    <tr>
                        <th>PLU</th>
                        <th>SKU</th>
                        <th>NAMA</th>
                        <th>QTY</th>
                        <th>SATUAN</th>
                        <th>HARGASATUAN</th>
                        <th>DISKON</th>
                        <th>BRUTO</th>
                        <th>NETTO</th>
                        <th>DIVISI</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($jual->detail as $dj)
                    <tr>
                        <td>{{$dj->plu}}</td>
                        <td>{{$dj->sku}}</td>
                        <td>{{$dj->barang->namadet}}</td>
                        <td>{{$dj->qty}}</td>
                        <td>{{$dj->sat->namasatuan}}</td>
                        <td>{{$dj->hjual}}</td>
                        <td>{{$dj->diskfix}}</td>
                        <td>{{$dj->subtotbruto}}</td>
                        <td>{{$dj->subtotnetto}}</td>
                        <td>{{$dj->div()->nama}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table  class="table display responsive">
                <tbody>
                    <tr><th>Total Qty</th><th width="100">{{ $jual->totqty }}</th></tr>
                    <tr><th>Total Bruto</th><th>{{ $jual->totbruto }}</th></tr>
                    <tr><th>Total Diskon</th><th>{{ $jual->totdiskon }}</th></tr>
                    <tr><th>Total Netto</th><th>{{ $jual->totnetto }}</th></tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<script type="text/javascript">
$('#tbdetail').DataTable({
    dom: 't',
    responsive: true,
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 1, targets: 2 },
        { responsivePriority: 1, targets: 3 },
        { responsivePriority: 1, targets: -2 },
        { responsivePriority: 1, targets: -3 },
        { responsivePriority: 1, targets: -4 },
    ]
});
</script>
@endsection