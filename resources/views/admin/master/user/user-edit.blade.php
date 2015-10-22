@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/user"><i class="fa fa-dashboard"></i>User Manager</a></li>
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
             
                {!! Form::model($user, ['role' => 'form', 'url' => '/user/' . $user->id, 'method' => 'PUT']) !!}
             
                <div class='form-group'>
                    {!! Form::label('first_name', 'First Name') !!}
                    {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                </div>
             
                <div class='form-group'>
                    {!! Form::label('last_name', 'Last Name') !!}
                    {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                </div>
             
                <div class='form-group'>
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('level', 'Level') !!}
                    {!! Form::select('level', array_merge(array($user->level => $user->level),['SUPER'=>'SUPER','MANAGER'=>'MANAGER','STAFF'=>'STAFF']), $user->level) !!}
                </div>
             
                <div class='form-group'>
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::label('photo', 'Photo') !!}
                    <img src="{{ asset($user->photo) }}" class="user-image" alt="User Image"/>
                    {!! Form::hidden('photo', $filename, ['class' => 'form-control']) !!}
                </div>
             
                <div class='form-group'>
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['placeholder' => 'Password :: Kosongan jika tidak berubah', 'class' => 'form-control']) !!}
                </div>
             
                <div class='form-group'>
                    {!! Form::label('password_confirmation', 'Confirm Password') !!}
                    {!! Form::password('password_confirmation', ['placeholder' => 'Confirm Password :: Kosongan jika tidak berubah', 'class' => 'form-control']) !!}
                </div>
             
                <div class='form-group'>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
             
                {!! Form::close() !!}
             
            </div>
        </div>
    </div>
</div>
@endsection