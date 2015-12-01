<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
  <meta name="_token" content="{{ csrf_token() }}"/>

  {!! Html::style('/bootstrap/css/bootstrap.min.css') !!}
  {!! Html::style('/fancybox/jquery.fancybox.css') !!}
  {!! Html::style('/fancybox/helpers/jquery.fancybox-buttons.css') !!}

  {!! Html::script('/fancybox/jquery.fancybox.pack.js') !!}
  {!! Html::script('/fancybox/jquery.mousewheel-3.0.6.pack.js') !!}

  <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- jQuery 2.1.3 -->
  <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
  <!-- jQuery UI 1.11.2 -->
  <script src="{{ asset('/plugins/jQueryUI/jQuery-ui-1.11.2.min.js') }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>    

@yield('head')

</head>
<body>
@yield('content')
</body>
</html>