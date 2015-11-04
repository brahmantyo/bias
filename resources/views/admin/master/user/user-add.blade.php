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
                {!! Form::itext('firstname','First Name','First Name of User',old('firstname'),false,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::itext('lastname','Last Name','Last Name of User',old('lastname'),false,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::itext('name','User Name','Login ID / Username for authenticated',old('name'),true,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::itext('email','Email','Email of User',old('email'),true,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::iselect('group','Group',$groups,old('group'),true,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::ipassword('password','Password','','',true,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::ipassword('password_confirmation','Confirm','','',true,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::icheckbox('status','Status',true,'Active or Inactive',true,\Session::get('privileges'),'btn_user_add') !!}
                {!! Form::bsubmit('Simpan',['back'=>'Cancel'],\Session::get('privileges'),'btn_user_add') !!}
            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection