@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/group"><i class="fa fa-dashboard"></i>Group User Administration</a></li>
    <li class="active">Add</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-users'></i> Add User Group</h1>
            </div>
            <div class="box-body" width="50%"> 
                @if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif
            
                {!! Form::open(['role' => 'form', 'url' => '/admin/group', 'class' => 'form-horizontal']) !!}
                    {!! Form::itext('groupname','Group Name','Name of Group',old('groupname')) !!}
                    {!! Form::iselect('groupparent','Group Parent',$parents,old('parent')) !!}
                    {!! Form::icheckbox('status','Status',old('status'),'Enabled') !!}
                    {!! Form::bsubmit('Simpan') !!}
                {!! Form::close() !!}
             
            </div>
        </div>
    </div>
</div>
@endsection