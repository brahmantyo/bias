@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/cabang"><i class="fa fa-share-alt"></i>Master Cabang</a></li>
    <li class="active">Add</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-share-alt'></i>Add Cabang</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/admin/cabang', 'class' => 'form-horizontal']) !!}
                {!! Form::itext('nama','Nama Cabang','Nama Cabang',old('nama'),true) !!}
                {!! Form::itext('alamat','Alamat Cabang','Alamat Cabang',old('alamat'),true) !!}
                {!! Form::itext('telp','Telp Cabang','Telepon Cabang',old('telp'),true) !!}
                {!! Form::bsubmit('Simpan',['back'=>'Cancel']) !!}
            {!! Form::close() !!}



            </div>
        </div>
    </div>
</div>
@endsection