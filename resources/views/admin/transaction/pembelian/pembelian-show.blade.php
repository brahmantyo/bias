@extends('app-modal')

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
                <tr><td>ID Pembelian</td><td> : {{ $beli->idbeli }}</td><td>Status</td><td> : {{ $beli->getstatus() }}</td></tr>
                <tr><td>ID PO</td><td> : {{ $beli->idpo }}</td><td>Keterangan</td><td> : {{ $beli->ket }}</td></tr>
                <tr><td>Tanggal</td><td> : {{ $beli->tglpo }}</td><td>Jatuh Tempo</td><td> : {{ $beli->tgljthtempo }}</td></tr>
                <tr><td>Supplier</td><td> : {{ $beli->supplier->nama }}</td><td>Entry oleh</td><td> : {{ $beli->createdby }}</td></tr>
                <tr><td>Surat Jalan</td><td> : {{ $beli->suratjalan }}</td><td>Tgl Entry</td><td> : {{ $beli->createdon }}</td></tr>
                <tr><td>Inv</td><td> : {{ $beli->inv }}</td></tr>

            </table>
            <table  class="table table-condensed table-striped table-bordered table-hover no-margin">
                <thead>
                    <tr>
                        <th>Divisi</th>
                        <th>PLU</th>
                        <th>SKU</th>
                        <th>Qty Unit</th>
                        <th>Hrg Unit</th>
                        <th>Qty Pjg</th>
                        <th>Hrg Pjg</th>
                        <th>Qty Berat</th>
                        <th>Hrg Berat</th>
                        <th>Titip Jual</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $count = 0;
                    $tqtyunit = 0;
                    $tqtypjg = 0;
                    $tqtybrt = 0;
                    $thrgunit = 0;
                    $thrgpjg = 0;
                    $thrgbrt = 0;

                ?>
                @foreach($beli->detail as $db)

                    <tr>
                        <td>{{$db->getdivisi->nama}}</td>
                        <td>{{$db->plu}}</td>
                        <td>{{$db->sku}}</td>
                        <td>{{$db->qtyunit}}</td>
                        <td>{{$db->hrgunit}}</td>
                        <td>{{$db->qtypjg}}</td>
                        <td>{{$db->hrgpjg}}</td>
                        <td>{{$db->qtybrt}}</td>
                        <td>{{$db->hrgbrt}}</td>
                        <td>{!! Form::checkbox('','',$db->konsi,['disabled']) !!}</td>
                    </tr>
                    <?php
                        $count++;
                        $tqtyunit += $db->qtyunit;
                        $tqtypjg += $db->qtypjg;
                        $tqtybrt += $db->qtybrt;
                        $thrgunit += $db->hrgunit;
                        $thrgpjg += $db->hrgpjg * $db->qtypjg;
                        $thrgbrt += $db->hrgbrt * $db->qtybrt;
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th>{{ $tqtyunit }}</th>
                        <th>{{ $thrgunit }}</th>
                        <th>{{ $tqtypjg }}</th>
                        <th>{{ $thrgpjg }}</th>
                        <th>{{ $tqtybrt }}</th>
                        <th>{{ $thrgbrt }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
 
@endsection