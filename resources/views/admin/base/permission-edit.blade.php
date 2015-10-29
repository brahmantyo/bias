@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/permission"><i class="fa fa-share-alt"></i>Master Permission</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-share-alt'></i>Edit Permission</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/admin/permission/'.$perm->privilegesid,'method'=>'PUT', 'class' => 'form-horizontal']) !!}
                {!! Form::itext('name','Object Name','Object Name',$perm->privilegesname,true) !!}
                {!! Form::itext('desc','Description','Description',$perm->privilegesdesc,true) !!}
                {!! Form::bsubmit('Simpan',['back'=>'Cancel']) !!}
            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection