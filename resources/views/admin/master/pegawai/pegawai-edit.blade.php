@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/pegawai"><i class="fa fa-users"></i>Master Pegawai</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-user'></i>Edit Pegawai</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/pegawai/edit/'.$pegawai->idpegawai]) !!}

                <div class='form-group'>
                    {!! Form::label('nama', 'Nama') !!}
                    {!! Form::text('nama', $pegawai->nama, ['placeholder' => 'Nama', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('alamat', 'Alamat') !!}
                    {!! Form::text('alamat', $pegawai->alamat, ['placeholder' => 'Alamat', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('jabatan', 'Jabatan') !!}
                    {!! Form::select('jabatan', $jabatan,$pegawai->idjabatan) !!}
                    {!! Form::button('Daftar Jabatan',['class' => 'btn btn-primary listitem', 'value' => '/jabatan']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('tglrekrut', 'Tanggal Rekrutmen') !!}
                    {!! Form::date('tglrekrut', $pegawai->tglrekrut, ['placeholder' => 'Tanggal Rekrutmen', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('gajipokok', 'Gaji Pokok') !!}
                    {!! Form::text('gajipokok', $pegawai->gajipokok, ['placeholder' => 'Gaji Pokok', 'class' => 'form-control']) !!}
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
<script type="text/javascript">
    $('input[name="tglrekrut"]').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        clearBtn: true,
        language: "id",
        orientation: "auto left",
        autoclose: true,
        todayHighlight: true
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('button.listitem').click(function(){return false;}).each(function(){
            $(this).fancybox({
                type : 'iframe',
                href : this.value,
                autoSize: true,
                height: 800,
                openSpeed: 1,
                closeSpeed: 1,
                ajax : {
                    dataType : 'html',
                },
                afterClose : function(){ window.location.replace('/pegawai/edit/{!!$pegawai->idpegawai!!}') },
            });
        });
    });
</script>
@endsection