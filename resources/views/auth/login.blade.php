@extends('app-login')

@section('content')

            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

{!! Form::open(['role'=>'form','url'=>'/auth/login','method'=>'POST','class'=>'form form-horizontal']) !!}
{!! Form::itext('name','Login ID','Username/Login ID',old('name'),true)!!}
{!! Form::ipassword('password','Password','Password',null,true) !!}
{!! Form::bsubmit('Login') !!}
{!! Form::close() !!}
@endsection