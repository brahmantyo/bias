@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/user"><i class="fa fa-dashboard"></i>User Manager</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-user'></i> Edit User</h1>
            </div>
            <div class="box-body" width="50%"> 
                @if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif

                {!! Form::model($user, ['role' => 'form', 'url' => '/admin/user/' . $user->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                    {!! Form::itext('firstname','First Name','First Name of User',$user->firstname) !!}
                    {!! Form::itext('lastname','Last Name','Last Name of User',$user->lastname) !!}
                    {!! Form::itext('login','Login ID','Login ID',$user->name,true) !!}
                    {!! Form::itext('email','Email','Email Address',$user->email,true) !!}
                    {!! Form::iselect('group','Group',$groups,$user->groupid,true) !!}

                    {!! Form::ipassword('password','Password','Password',$user->password,true) !!}
                    {!! Form::ipassword('password_confirmation','Confirmation','Password Confirmation',$user->password,true) !!}
                    {!! Form::icheckbox('status','Status',$user->status,'Enabled') !!}

                    {!! Form::bsubmit('Save',['back'=>'Cancel']) !!}
                {!! Form::close() !!}

             
            </div>
        </div>
    </div>
</div>
@endsection