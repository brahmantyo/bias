@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/konsumen"><i class="fa fa-users"></i>Master Konsumen</a></li>
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

            {!! Form::open(['role' => 'form', 'url' => '/konsumen/edit/'.$konsumen->idkonsumen]) !!}

                <div class='form-group'>
                    {!! Form::label('nama', 'Nama') !!}
                    {!! Form::text('nama', $konsumen->nama, ['placeholder' => 'Nama', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('alamat', 'Alamat') !!}
                    {!! Form::text('alamat', $konsumen->alamat, ['placeholder' => 'Alamat', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('kota','Kota') !!}
                    {!! Form::select('kota',array_merge(['--Pilih Kota--'],$kota),$konsumen->kota,['class'=>'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('telp', 'Telp') !!}
                    {!! Form::text('telp', $konsumen->notelp, ['placeholder' => 'Telp', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $konsumen->email, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('contact', 'Contact') !!}
                    {!! Form::text('contact', $konsumen->cp, ['placeholder' => 'Contact', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    {!! Form::button('Cancel', ['class' => 'btn btn-info','onclick'=>'window.history.back()']) !!}
                </div>

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection