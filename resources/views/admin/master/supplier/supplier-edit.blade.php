@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/group"><i class="fa fa-dashboard"></i>Group User Administration</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-users'></i> Edit User Group</h1>
            </div>
            <div class="box-body" width="50%"> 
                @if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif
            
                {!! Form::model($group, ['role' => 'form', 'url' => '/admin/group/' . $group->groupid, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                    {!! Form::itext('groupname','Group Name','Name of Group',$group->groupname) !!}
                    {!! Form::iselect('groupparent','Group Parent',$parents,$group->parent) !!}
                    {!! Form::icheckbox('status','Status',$group->status,'Enabled') !!}
                    {!! Form::bsubmit('Simpan',['back'=>'Cancel']) !!}
                {!! Form::close() !!}
             
            </div>
        </div>
    </div>
</div>
@endsection