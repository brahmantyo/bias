@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/konsumen"><i class="fa fa-users"></i>Master Konsumen</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-user'></i>Edit Konsumen</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/admin/konsumen/' . $konsumen->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                {!! Form::itext('nama','Nama Perusahaan','Nama Perusahaan Konsumen',$konsumen->nama,true) !!}
                {!! Form::itext('alamat','Alamat','Alamat Perusahaan',$konsumen->alamat,true) !!}
                {!! Form::itext('telp','Telepon','Nomer Telepon',$konsumen->telp,true) !!}
                {!! Form::itext('email','Email','Email Address',$konsumen->email,true) !!}
                {!! Form::itext('contact','Contact Person','Name of Contact Person',$konsumen->cp,true) !!}
                {!! Form::bsubmit('Save',['back'=>'Cancel']) !!}
            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection