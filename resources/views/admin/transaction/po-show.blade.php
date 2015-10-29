@extends('app')

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
                <tr><td>ID PO</td><td> : {{ $po->idpo }}</td></tr>
                <tr><td>Tanggal</td><td> : {{ $po->tglpo }}</td></tr>
                <tr><td>Supplier</td><td> : {{ $po->idsupp }}</td></tr>
                <tr><td>Status</td><td> : {{ $po->status }}</td></tr>
                <tr><td>Keterangan</td><td> : {{ $po->ket }}</td></tr>
                <tr><td>Mata Uang</td><td> : {{ $po->matauang }}</td></tr>
                <tr><td>Cara Bayar</td><td> : {{ $po->bayar }}</td></tr>
                <tr><td>No.Kontrak</td><td> : {{ $po->contractno }}</td></tr>
                <tr><td>Term. Bayar</td><td> : {{ $po->paymentterms }}</td></tr>
            </table>
            <table  class="table table-condensed table-striped table-bordered table-hover no-margin">
                <thead>
                    <tr>
                        <th>PLU</th>
                        <th>Qty</th>
                        <th>Harga/Qty</th>
                        <th>Sub.Total</th>
                        <th>Perkiraan Selesai</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($po->detail as $dpo)
                    <tr>
                        <td>{{$dpo->plu}}</td>
                        <td>{{$dpo->qty}}</td>
                        <td>{{$dpo->harga}}</td>
                        <td>{{$dpo->qty * $dpo->harga}}</td>
                        <td>{{$dpo->est_delivery}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="#" onclick="history.back();" class="btn btn-warning pull-left" style="margin-right: 3px;">Close</a>
        </div>
    </div>

</div>
 
@endsection