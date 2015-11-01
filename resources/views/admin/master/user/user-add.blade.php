@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/user"><i class="fa fa-user-secret"></i>User Manager</a></li>
    <li class="active">Add</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-user'></i> Add User</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{{ $error }}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/admin/user', 'class' => 'form-horizontal']) !!}
                {!! Form::itext('firstname','First Name','First Name of User',old('firstname')) !!}
                {!! Form::itext('lastname','Last Name','Last Name of User',old('lastname')) !!}
                {!! Form::itext('name','User Name','Login ID / Username for authenticated',old('name'),true) !!}
                {!! Form::itext('email','Email','Email of User',old('email'),true) !!}
                {!! Form::iselect('group','Group',$groups,old('group'),true) !!}
                {!! Form::ipassword('password','Password') !!}
                {!! Form::ipassword('password_confirmation','Password Confirm') !!}
                {!! Form::icheckbox('status','Status',true,'',true) !!}

                {!! Form::bsubmit('Simpan',['back'=>'Cancel']) !!}
            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection