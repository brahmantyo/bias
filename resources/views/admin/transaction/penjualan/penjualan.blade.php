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
                    {!! Form::open(['url'=>'/admin/penjualan/search','method'=>'GET','class'=>'form-horizontal']) !!}
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
                </span>                
            </div>
            <div class="box-body table-responsive">
                @if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif
                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                    <thead>
                        <tr>
                            <th>ID Penjualan</th>
                            <th>Tgl</th>
                            <th>Konsumen</th>
                            <th>Sales</th>
                            <th>Payment</th>
                            <th>Tempo</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Bruto</th>
                            <th>Disc</th>
                            <th>Netto</th>
                            <th>Keterangan</th>
                            <th>Kasir</th>
                            <th width="200"></th>
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
                            <td>{{ $j->idtrx }}</td>
                            <td>{{ $j->tgl }}</td>
                            <td>{{ $j->konsumen->nama }}</td>
                            <td>{{ $j->sales->nama }}</td>
                            <td>{{ $j->payment }}</td>
                            <td>{{ $j->tempo }}</td>
                            <td>{{ $j->detail->sum('qty') }}</td>
                            <td>{{ $j->detail->getDivisi }}</td>
                            <td>{{ $j->totbruto }}</td>
                            <td>{{ $j->totdiskon }}</td>
                            <td>{{ $j->totnetto }}</td>
                            <td>{{ $j->ket }}</td>
                            <td>{{ $j->kasir }}</td>
                            <td>
                                <a href="/admin/penjualan/show/{{ $j->idtrx }}" class="btn btn-success pull-right" style="margin-right: 3px;">Detail</a>
<!--                                 <a href="/admin/penjualan/{{ $j->idtrx }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                {!! Form::open(['url' => '/admin/penjualan/' . $j->idtrx, 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
 -->                            </td>
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
                        <tr>
                            <th colspan="6">Total</th>
                            <th>{{ $tqty }}</th>
                            <th></th>
                            <th>{{ $tbruto }}</th>
                            <th>{{ $tdisc }}</th>
                            <th>{{ $tnetto }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>

                </table>
                <div class="pull-right">{!! $jual->render() !!}</div>
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
</script>
@endsection