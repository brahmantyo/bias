@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-users"></i>Pembelian</li>
</ol>
@endsection
 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <span><h1><i class="fa fa-user-secret"></i>Pembelian</h1></span>
                <hr>
                <span>
                    {!! Form::open(['url'=>'/admin/pembelian/search','method'=>'GET','class'=>'form-horizontal']) !!}
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
                            <th>ID Pembelian</th>
                            <th>ID PO</th>
                            <th>Tgl</th>
                            <th>Supplier</th>
                            <th width="200"></th>
                        </tr>
                    </thead>
         
                    <tbody>
                        @foreach ($beli as $b)
                        <tr>
                            <td>{{ $b->idbeli }}</td>
                            <td>{{ $b->idpo }}</td>
                            <td>{{ $b->tglbeli }}</td>
                            <td>{{ $b->supplier->nama }}</td>
                            <td>
                                <a href="/admin/pembelian/show/{{ $b->idbeli }}" class="btn btn-success pull-right" style="margin-right: 3px;">Detail</a>
<!--                                 <a href="/admin/pembelian/{{ $b->idbeli }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                {!! Form::open(['url' => '/admin/pembelian/' . $b->idbeli, 'method' => 'DELETE']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
 -->                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">{!! $beli->render() !!}</div>
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
        afterClose : function(){ window.location.replace('/admin/pembelian') },
    });
</script>
@endsection