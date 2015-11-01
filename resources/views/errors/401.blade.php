@extends('app')

@section('content')
        <div class='bg-danger alert'>
        	<div><h2>Maaf Anda tidak memiliki hak akses untuk operasi ini :</h2></div>
        	<div>Permission : <span class="text-warning">{{$error}}</span></div>
		</div>
		<a onclick="history.back()"><span  class="btn btn-primary pull-right">Back</span></a>
@endsection