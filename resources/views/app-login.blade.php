<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{\Config::get('appname')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />    
    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>


    <style type="text/css">
        @media (max-width: 768px) {
          body {
            background: url('image/loginpage-xs.png') no-repeat;
        /*    width: 100%;
            height:100vh;*/
          }
          .form {
            background: url('image/form.png') no-repeat;
            color: white;
            position: absolute;
            min-width:80%;
            top: 20%;
            left:20%;
            transform: translate(-50%,-50%);
            padding: 10px;
            padding-top: 100px;    
          }
        }

        @media (min-width: 768px) {
          body {
            background: url('image/loginpage-md.png') no-repeat;
            width: 100%;
            height:100vh;
          }
          .form {
            background: url('image/form.png') no-repeat;
            color: white;
            position: absolute;
            min-width:300px;
            top: 50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding: 10px;
            padding-top: 100px;    
            border: 1px dashed white;
          }
        }

        @media (min-width: 1200px) {
          body {
            background: url('image/loginpage-lg.png') no-repeat;
            width: 100%;
            height:100vh;
          }
          .form {
            background: url('image/form.png') no-repeat;
            color: white;
            position: absolute;
            min-width:300px;
            top: 50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding: 10px;
            padding-top: 100px;    
            border: 1px dashed white;
          }
        }

    </style>
</head>
<body>
    <div class="container">
            @yield('content')
    </div>

</body>
</html>
