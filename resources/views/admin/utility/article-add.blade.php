@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/article"><i class="fa fa-pencil-square-o "></i>Article</a></li>
    <li class="active">Add</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-pencil-square-o '></i>Add Article</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/article']) !!}
                <div>
                    <a id="meta">Untuk kebutuhan mesin pencari internet <i class="fa fa-caret-down"></i></a>
                </div>
                <div id="meta-tag">
                    <div class='form-group'>
                        {!! Form::label('author', 'Author') !!}
                        {!! Form::text('author', old('author'), ['placeholder' => 'author', 'class' => 'form-control']) !!}
                        <span>{!! Form::checkbox('setauthor','user') !!} Set User saat ini sebagai Author</span> 
                    </div>
                    <div class='form-group'>
                        {!! Form::label('keywords', 'Keywords') !!}
                        {!! Form::text('keywords', old('keywords'), ['placeholder' => 'keywords', 'class' => 'form-control']) !!}
                    </div>
                    <div class='form-group'>
                        {!! Form::label('description', 'Deskripsi') !!}
                        {!! Form::text('description', old('description'), ['placeholder' => 'description about this page', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <hr>
                <div class='form-group'>
                    {!! Form::label('judul', 'Judul') !!}
                    {!! Form::text('judul', old('judul'), ['placeholder' => 'Judul About', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('jenis', 'Jenis') !!}
                    {!! Form::select('jenis', ['about'=>'About','news'=>'Berita','memo'=>'Catatan'],old('jenis'),['class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('tags', 'Tags') !!}
                    {!! Form::text('tags', old('tags'), ['placeholder' => 'Tag untuk artikel ini, pisahkan antar Tag dengan titik koma (Contoh: berita;bandung;daftar)', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('short', 'Deskripsi Singkat') !!}
                    {!! Form::textarea('short', old('content'), ['placeholder' => 'Deskripsi singkat tentang artikel ini. Akan ditampilkan di halaman depan', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('content', 'Isi Artikel') !!}
                    {!! Form::textarea('content', old('content'), ['placeholder' => 'Isi artikel di sini', 'class' => 'form-control']) !!}
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

<style type="text/css">
    #meta-tag {
        display: none;
    }
</style>

<!-- CK Editor -->
<script src="{{ asset('/plugins/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">
    $('#meta').click(function(){
        $('#meta-tag').toggle();
    });
	$(function () {
    	// Replace the <textarea id="editor"> with a CKEditor
    	// instance, using default configuration.
        CKEDITOR.replace('short');
        
        CKEDITOR.replace('content',{
            height:600
        });	});
</script>
@endsection