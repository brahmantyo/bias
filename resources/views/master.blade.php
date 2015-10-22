<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lanogan Sumatra Express</title>
  @yield('meta-author')
  @yield('meta-keywords')
  @yield('meta-description')
  <meta name="date" content="2015-06-17T04:26:13+0700" >
  <meta name="copyright" content="niclogic">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
  <meta http-equiv="content-style-type" content="text/css">
  <meta http-equiv="expires" content="0">
  <meta name="_token" content="{{ csrf_token() }}"/>
  <!-- Bootstrap 3.3.2 -->
  <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Fancy Box -->
    {!! Html::style('/fancybox/jquery.fancybox.css') !!}
    {!! Html::style('/fancybox/helpers/jquery.fancybox-buttons.css') !!}   

  <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

  <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

  <script src="{{ asset('plugins/datatables/jquery.dataTables-1.10.6.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.rowGrouping.js') }}"></script>

    <!-- Fancy Box -->
    {!! Html::script('/fancybox/jquery.fancybox.pack.js') !!}
    {!! Html::script('/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}

</head>
<body>
<style type="text/css">
  body {
    /* Margin bottom by footer height */
    margin-bottom: 60px;
    background-image: url("{{asset('dist/img/bg.png')}}");
    background-color: #042045;
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: top;
    background-attachment: fixed;
  }
  
  .container {
    display:block;
    background:rgba(255, 255, 255,0.5);
    padding: 20px;
  }

  .jumbotron {
    border-radius: 20px !important;
    /*background-image:url('{{asset('dist/img/banner.png')}}');*/
    background-repeat: no-repeat;
    background-size: contain;
    background-position: right;
    max-height: 467px;
  }
  .tab-content {
    background-color: #fff;
  }
  footer {
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 30px;
    color: #fff;
    background-color: #333;
  }
</style>
<!--   Header section -->

      <div class="container">
        <div class="row">
          <div class="well" style="border-radius: 20px">
            <a href="/"><img src="{{asset('dist/img/banner.png')}}" class="img-responsive"></a>
          </div>
        </div>
<!--  End of header section -->

<!--  Content section -->
      <div class="row">
        <div class="panel col-md-12">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home" >Home</a></li>
            <li><a data-toggle="tab" href="#info">Informasi</a></li>
            <li><a data-toggle="tab" href="#tracking">Tracking</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tentang Kami<span class="caret"></span></a>
              <ul class="dropdown-menu">
              @foreach($abouts as $about)
                <li><a data-toggle="tab" href="#{{$about->type.'-'.$about->id}}">{{$about->title}}</a></li>
              @endforeach
              </ul>
            </li>
            @if(!Auth::guest())
              <?php $dashboard = (Auth::user()->level=='KONSUMEN')?'/konsumenpanel':'/admin'; ?>
            <div class='pull-right'>
              <a href="{{ $dashboard }}" class="btn btn-success btn-sm" ><i class="fa fa-user"></i> KONSUMEN AREA</a>
              <a href="/auth/logout" class="btn btn-info btn-sm" ><i class="fa fa-unlock"></i> LOGOUT</a>
            </div>
            @endif
            <div class="dropdown pull-right" style="display:none">
              <a href="#" class="dropdown-toggle btn btn-info btn-sm" data-toggle="dropdown"><i class="fa fa-lock"></i> LOGIN</a>
              <ul class="dropdown-menu"  style="min-width: 200px;">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <fieldset class="form-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Login" name="name" value="{{ old('name') }}">
                  </fieldset>
                  <fieldset class="form-group col-lg-12">
                    <input type="password" placeholder="Password" class="form-control" name="password">
                  </fieldset>
                  <fieldset class="form-group col-lg-12 pull-right">
                    <button type="submit" class="btn btn-primary">LOGIN</button>
                  </fieldset>
                </form>
              </ul>
            </div>
          </ul>
        </div>
        <div class="panel-body">
        @if($errors->has())
          @foreach ($errors->all() as $k=>$error)
            @if(substr($error,0,7)=='Success')
            <div class='bg-success alert'>{!! $error !!}</div>
            @else
            <div class='bg-danger alert'>{!! $error !!}</div>
            @endif
          @endforeach
        @endif      

        <div class="tab-content {{ Auth::guest()?'col-md-10':'col-md-12' }}">
          <div id="home" class="tab-pane fade in active">
              @if(\Request::get('detail'))
                @include('world.news')                
              @else
              @foreach($news as $n)
                <div class="panel panel-primary">
                  <div class="panel-heading"><h4><b>{{ strtoupper($n->title) }}</b></h4></div>
                  <div class="panel-body">
                  <h6><i><b>{{ ucfirst($n->first_name) }} {{ ucfirst($n->last_name) }}</b>, {{ date_format($n->created_at,'d-m Y h:m:s') }}</i>  </h6>
                  <p class="lead">{!! $n->scontent !!} (<a href="/news/{{ $n->id }}/?detail=1">More</a>)</p>
                  </div>
                  
                </div>
              @endforeach
              @endif
          </div>
          <div id="info" class="tab-pane fade">
            <div class="panel panel-primary">
              <div class="panel-heading">Halaman Informasi</div>
              <div class="panel-body">
                <ol>
                  @foreach($memo as $m)
                  <li>
                    <a href="/info/{{ $m->id }}/?detail=1" target="_blank">{{ strtoupper($m->title) }}</a>
                  </li>
                  @endforeach
                </ol>
               </div>
            </div>
          </div>          
          <div id="tracking" class="tab-pane fade">
            <div class="panel panel-primary">
              <div class="panel-heading">Informasi Status Pengiriman</div>
              <div class="panel-body">
                @include('world.tracking')
              </div>
            </div>
          </div>
          @foreach($abouts as $about)
          <div id="{{$about->type.'-'.$about->id}}" class="tab-pane fade">
            <div class="panel panel-primary">
            <div class="panel-heading"><h4><b>{!! strtoupper($about->title) !!}</b></h4></div>
            <div class="panel-body">
            <p class="lead">{!! $about->content !!}</p>
            </div>
            </div>
          </div>
          @endforeach
        </div>
        @if(Auth::guest())
        <div class="col-md-2">
          <div class="row">
              <a href="#daftar" class="btn btn-success btn-lg col-md-12">Konsumen Baru</a>
          </div>
          <div>&nbsp;</div>
          <div class="row">
            {!! Form::loginForm('login','/auth/login','Konsumen Area','LOGIN',$errors) !!}
          </div>
        </div>        
        @endif
        </div>
      </div>
      <div class="panel panel-danger ">

      </div>
      </div>
    </div>
<!-- End Content section -->

          @yield('content')

<!--  Footer section -->
  <footer>
      <div >
        <div class="col-md-12">
          <b><strong>Copyright &copy; 2014-2015 <a href="#">Niclogic</a>.</strong> All rights reserved.</div>
      </div>
  </footer>
<!--  Footer section -->
<div id="daftar" style="display:none">
  <style type="text/css">
    fieldset.panel > legend:nth-child(1) {
      width: auto; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom: none;
        margin-bottom: 5px;
    }
  
    #items input {
      width:100%;
      padding:5px;
      border: none;
    }
    #items input:focus,
    #items input.focus {
      box-shadow: inset 1px 1px 2px 0 #c9c9c9;
    }
    #items select {
      width:100%;
      padding:5px;
      border: none;
    }
    #items select:focus,
    #items select.focus {
      box-shadow: inset 1px 1px 2px 0 #c9c9c9;
    }
  
    .form-group.required .control-label:after { 
        color: #d00;
        content: "*";
        position: absolute;
        margin-left: 8px;
        top:7px;
        font-family: 'FontAwesome';
      font-weight: normal;
      font-size: 10px;
      content: "\f069";
    }
  </style>
  {!! Form::open(['url'=>'/daftar','class'=>'form-horizontal']) !!}
    <fieldset class="col-md-12">
      <legend>Pendaftaran Konsumen Baru</legend>
      <div class="form-group {{ $errors->has('userid') ? 'has-error' : '' }} required">
        {!! Form::label('userid','User ID',['class'=>'control-label required col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::text('userid',old('userid'),['placeholder'=>'User ID','class'=>'form-control','required']) !!}
          {!! $errors->first('userid', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} required">
        {!! Form::label('password','Password',['class'=>'control-label required col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::input('password','password',old('password'),['placeholder'=>'Password','class'=>'form-control','required']) !!}
          {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group {{ $errors->has('password-confirm') ? 'has-error' : '' }} required">
        {!! Form::label('confirm','Konfirmasi Password',['class'=>'control-label required col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::input('password','confirm',old('confirm'),['placeholder'=>'Konfirmasi Password','class'=>'form-control','required']) !!}
          {!! $errors->first('confirm', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <hr>
      <div class="form-group {{ $errors->has('nmdepan') ? 'has-error' : '' }} required">
        {!! Form::label('nmdepan','Nama Depan',['class'=>'required control-label col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::text('nmdepan',old('nmdepan'),['placeholder'=>'Nama depan contact person','class'=>'form-control','required']) !!}
          {!! $errors->first('nmdepan', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('nmbelakang','Nama Belakang',['class'=>'control-label col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::text('nmbelakang',old('nmbelakang'),['placeholder'=>'Nama belakang contact person','class'=>'form-control']) !!}
          {!! $errors->first('nmbelakang', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('nmperusahaan','Nama Perusahaan',['class'=>'control-label col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::text('nmperusahaan',old('nmperusahaan'),['placeholder'=>'Kosongkan jika bukan perusahaan','class'=>'form-control']) !!}
          {!! $errors->first('nmperusahaan', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} required">
        {!! Form::label('email','Email',['class'=>'control-label col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::email('email',old('email'),['placeholder'=>'Email pengirim wajib diisi','class'=>'form-control','required']) !!}
          {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group {{ $errors->has('notelp') ? 'has-error' : '' }} required">
        {!! Form::label('telp','No. Telp',['class'=>'control-label col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::text('telp',old('telp'),['placeholder'=>'Nomer telepon perusahaan/pribadi pengirim (wajib diisi)','class'=>'form-control','required']) !!}
          {!! $errors->first('telp', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }} required">
        {!! Form::label('alamat','Alamat',['class'=>'control-label col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::textarea('alamat',old('alamat'),['placeholder'=>'Alamat perusahaan pengirim atau alamat pribadi jika bukan perusahaan','class'=>'form-control','rows'=>'5','required']) !!}
          {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group {{ $errors->has('kota') ? 'has-error' : '' }} required">
        {!! Form::label('kota','Kota',['class'=>'control-label col-md-4']) !!}
        <div class="col-md-8">
          {!! Form::select('kota',array_merge(['--Pilih Kota--'],$kota),old('kota'),['class'=>'form-control','required']) !!}
          {!! $errors->first('kota', '<p class="help-block">:message</p>') !!}
        </div>
      </div>
      <div class="form-group">
        {!! Form::submit('Daftar',['class'=>'btn btn-info']) !!}
      </div>
    </fieldset>
  {!! Form::close() !!}
</div>
@if(isset($track))
<script type="text/javascript">
    $('*').removeClass('in').removeClass('active');
    $('a:contains("Tracking")').parent().addClass('active');
    $('#tracking').addClass('active').addClass('in');
</script>
@endif
@if(session()->has('errorsorder'))
<script type="text/javascript">
    $('a:contains("Order")').tab('show');
</script>
@elseif(isset($successorder))
<script type="text/javascript">
    $('a:contains("Order")').tab('show');
</script>
@endif
<script type="text/javascript">
  $('a:contains("Konsumen Baru")').fancybox();
</script>
</body>
</html>
