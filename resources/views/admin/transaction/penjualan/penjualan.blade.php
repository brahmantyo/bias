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
                <hr>
                <span>
                    {!! Form::open(['url'=>'/admin/penjualan','method'=>'GET','class'=>'form-horizontal']) !!}
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                {!! Form::text('s',old('s'),['placeholder'=>'Search everything here ...','class'=>'form-control input-group-addon ']) !!}
                                <span class="input-group-btn">
                                    {!! Form::submit('Search',['class'=>'btn btn-success']) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <a href="#asearch">Advanced Search</a>
                </span>
                <span id='asearch' style="display:none">
                    <h3>Advanced Search</h3>
                    {!! Form::open(['url'=>'/admin/penjualan','class'=>'form-inline']) !!}
                    <div class="col-lg-12">
                            <div class="input-control">
                                <label class="control-label ">Range Tanggal</label>
                                {!! Form::text('tgl1',old('tgl1'),['placeholder'=>'Tanggal Awal','class'=>'form-control']) !!}
                                {!! Form::text('tgl2',old('tgl2'),['placeholder'=>'Tanggal Akhir','class'=>'form-control']) !!}
                                {!! Form::checkbox('ctgl',old('ctgl')) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Divisi</label>
                                {!! Form::select('divisi',$divisi,old('divisi'),['class'=>'form-control']) !!}
                                {!! Form::checkbox('cdivisi',old('cdivisi')) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Konsumen</label>
                                {!! Form::text('konsumen',old('konsumen'),['placeholder'=>'Nama Konsumen','class'=>'form-control']) !!}
                                {!! Form::checkbox('ckonsumen',old('ckonsumen')) !!}
                            </div>
                            <div class="input-control">
                                <label class="control-label ">Sales</label>
                                {!! Form::text('sales',old('saless'),['placeholder'=>'Tanggal Awal','class'=>'form-control']) !!}
                                {!! Form::text('tgl2',old('tgl2'),['placeholder'=>'Tanggal Akhir','class'=>'form-control']) !!}
                                {!! Form::checkbox('tgl','Range Tanggal',old('tgl')) !!}
                            </div>
                    </div>
                    {!! Form::submit('Search',['class'=>'btn btn-success']) !!}
                    {!! Form::close() !!}
                </span>
            </div>
            <div class="box-body table-responsive">
                @if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif

                <div class="col-lg-12 col-sm-12">
                    <div class="col-lg-4 pull-left">
                    {!! Form::open(['url'=>'/admin/penjualan','method'=>'GET','class'=>'form-horizontal']) !!}
                        <div class="form-group" style="max-width:200px">
                            <div class="input-group">
                                {!! Form::select('show',['5'=>'5','10'=>'10','50'=>'50','100'=>'100','all'=>'All'],\Config::get('pages'),['class'=>'form-control']) !!}
                                <span class="input-group-btn">
                                    {!! Form::submit('Pages',['class'=>'btn btn-success']) !!}
                                </span>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                    <style type="text/css">
                    .pagination {
                        margin : 0px !important;
                    }
                    </style>
                    <div class="offset-lg-4 pull-right">
                    {!! $jual->render() !!}
                    </div>
                </div>


                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                    <thead>
                        <tr>
                            <th width="20"></th>
                            <th>ID Penjualan</th>
                            <th>Tgl</th>
                            <th>Konsumen</th>
                            <th>Sales</th>
                            <th>Divisi</th>
                            <th>Payment</th>
                            <th>Tempo</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Bruto</th>
                            <th>Disc</th>
                            <th>Netto</th>
                            <th>Keterangan</th>
                            <th>Kasir</th>
                        </tr>
                    </thead>
         
                    <tbody>
                        <?php
                            $tqty=0;
                            $tbruto=0;
                            $tdisc=0;
                            $tnetto=0;
                        ?>
                        @foreach ($jual as $j)
                        <tr>
                            <td>
                                <a href="/admin/penjualan/show/{{ $j->idtrx }}" class="btn btn-success pull-right" style="margin-right: 3px;">Detail</a>
<!--                                 <a href="/admin/penjualan/{{ $j->idtrx }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                {!! Form::open(['url' => '/admin/penjualan/' . $j->idtrx, 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
 -->                        </td> 
                            <td>{{ $j->idtrx }}</td>
                            <td>{{ $j->tgl }}</td>
                            <td>{{ $j->konsumen->nama }}</td>
                            <td>{{ $j->sales->nama }}</td>
                            <td>{{ $j->sales->divisi()->nama }}</td>
                            <td>{{ $j->payment }}</td>
                            <td>{{ $j->tempo }}</td>
                            <td style="text-align:right">{{ \App\Helpers::currency($j->detail->sum('qty')) }}</td>
                            <td></td>
                            <td style="text-align:right">{{ \App\Helpers::currency($j->totbruto )}}</td>
                            <td style="text-align:right">{{ \App\Helpers::currency($j->totdiskon) }}</td>
                            <td style="text-align:right">{{ \App\Helpers::currency($j->totnetto )}}</td>
                            <td>{{ $j->ket }}</td>
                            <td>{{ $j->kasir }}</td>

                        </tr>
                        <?php
                            $tqty = $tqty + $j->totqty;
                            $tbruto = $tbruto + $j->totbruto;
                            $tdisc = $tdisc + $j->totdiskon;
                            $tnetto = $tnetto + $j->totnetto;
                        ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="text-align:right">
                            <th colspan="8">Total</th>
                            <th style="text-align:right">{{ \App\Helpers::currency($tqty) }}</th>
                            <th></th>
                            <th style="text-align:right">{{ \App\Helpers::currency($tbruto) }}</th>
                            <th style="text-align:right">{{ \App\Helpers::currency($tdisc) }}</th>
                            <th style="text-align:right">{{ \App\Helpers::currency($tnetto) }}</th>
                            <th colspan="2"></th>
                        </tr>
                        <tr style="text-align:right">
                            <th colspan="8">Grand Total (  {{ $total }} rows)</th>
                            <th style="text-align:right">{{ \App\Helpers::currency($totqty) }}</th>
                            <th></th>
                            <th style="text-align:right">{{ \App\Helpers::currency($totbruto) }}</th>
                            <th style="text-align:right">{{ \App\Helpers::currency($totdiskon) }}</th>
                            <th style="text-align:right">{{ \App\Helpers::currency($totnetto) }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>

                </table>
                <div class="pull-left">

                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="col-lg-4 pull-left">
                    {!! Form::open(['url'=>'/admin/penjualan','method'=>'GET','class'=>'form-horizontal']) !!}
                        <div class="form-group" style="max-width:200px">
                            <div class="input-group">
                                {!! Form::select('show',['5'=>'5','10'=>'10','50'=>'50','100'=>'100','all'=>'All'],\Config::get('pages'),['class'=>'form-control']) !!}
                                <span class="input-group-btn">
                                    {!! Form::submit('Pages',['class'=>'btn btn-success']) !!}
                                </span>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    </div>
                    <style type="text/css">
                    .pagination {
                        margin : 0px !important;
                    }
                    </style>
                    <div class="offset-lg-4 pull-right">
                    {!! $jual->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('a:contains("Detail")').fancybox({
        type : 'iframe',
        href : this.value,
        autoSize: false,
        width: 1024,
        height: 800,
        openSpeed: 1,
        closeSpeed: 1,
        ajax : {
            dataType : 'html',
        },
        afterClose : function(){ window.location.replace('/admin/penjualan') },
    });
    $('a:contains("Advanced Search")').fancybox({
        href : this.value,
        autoSize: true,
        openSpeed: 1,
        closeSpeed: 1,
    });
</script>
@endsection