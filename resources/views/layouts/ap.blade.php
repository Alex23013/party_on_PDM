<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title>GdT | Log in</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
     <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Ionicons -->
     <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
     <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('css/blue.css') }}" rel="stylesheet">

    
    <!-- Fonts -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
     <style type="text/css">
      body {
        background-color: #c2f0f0;
      }

     </style>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    
    @include('layouts.header')
<section class="content">
      @yield('content')  
    </section>
    <!-- /.content -->
  </div>

  <!-- jQuery 3 -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

  </body>
</html>