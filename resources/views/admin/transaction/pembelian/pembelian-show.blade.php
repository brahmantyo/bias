@extends('app')

@section('content-header')
<h1>
User Manager
<small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/pembelian"><i class="fa fa-dashboard"></i>Pembelian</a></li>
    <li class="active">Detail</li>
</ol>
@endsection

@section('content')
 
<div class='col-lg-10 col-lg-offset-1'>
 
    <h1><i class='fa fa-user'></i>Pembelian Detail</h1>
 
    <div class="well col-lg-12">
        <div class="col-lg-12">
            <table height="100%" class="table table-condensed table-striped table-bordered no-margin">
                <tr><td>ID Pembelian</td><td> : {{ $beli->idbeli }}</td></tr>
                <tr><td>ID PO</td><td> : {{ $beli->idpo }}</td></tr>
                <tr><td>Tanggal</td><td> : {{ $beli->tglpo }}</td></tr>
                <tr><td>Supplier</td><td> : {{ $beli->supplier->nama }}</td></tr>
                <tr><td>Surat Jalan</td><td> : {{ $beli->suratjalan }}</td></tr>
                <tr><td>Inv</td><td> : {{ $beli->inv }}</td></tr>
                <tr><td>Status</td><td> : {{ $beli->getstatus() }}</td></tr>
                <tr><td>Keterangan</td><td> : {{ $beli->ket }}</td></tr>
                <tr><td>Jatuh Tempo</td><td> : {{ $beli->tgljthtempo }}</td></tr>
                <tr><td>Entry oleh</td><td> : {{ $beli->createdby }}</td></tr>
                <tr><td>Tgl Entry</td><td> : {{ $beli->createdon }}</td></tr>
            </table>
            <table  class="table table-condensed table-striped table-bordered table-hover no-margin">
                <thead>
                    <tr>
                        <th>PLU</th>
                        <th>Qty Unit</th>
                        <th>Hrg Unit</th>
                        <th>Qty Pjg</th>
                        <th>Hrg Pjg</th>
                        <th>Qty Berat</th>
                        <th>Hrg Berat</th>
                        <th>SKU</th>
                        <th>Divisi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($beli->detail as $db)
                    <tr>
                        <td>{{$db->plu}}</td>
                        <td>{{$db->qtyunit}}</td>
                        <td>{{$db->hrgunit}}</td>
                        <td>{{$db->qtypjg}}</td>
                        <td>{{$db->hrgpjg}}</td>
                        <td>{{$db->qtybrt}}</td>
                        <td>{{$db->hrgbrt}}</td>
                        <td>{{$db->sku}}</td>
                        <td>{{$db->getdivisi->nama}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="#" onclick="history.back();" class="btn btn-warning pull-left" style="margin-right: 3px;">Close</a>
        </div>
    </div>

</div>
 
@endsection