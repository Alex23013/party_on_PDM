<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> DocDoor | Inicio </title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
    
    
    
    <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    

    <!-- fullCalendar 
    <link href="{{ asset('css/calendar/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar/fullcalendar.min.css') }}" rel="stylesheet">-->

    <!-- DataTables -->
    <link href="{{ asset('css/dataTables.bootstrap.css') }}"  rel="stylesheet" >

    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/_all-skins.min.css') }}" rel="stylesheet">


    

    <!-- font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- //font -->

    <!-- jQuery 3 js/jquery-1.8.3.min.js -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo.js') }}"></script>
    <!-- fullCalendar 
    <script src="{{ asset('js/calendar/moment.js') }}"></script>
    
    <script src="{{ asset('js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/calendar/es.js') }}"></script>-->
    <!-- DataTables -->
    <script src="{{ asset('js/jquery/jquery.dataTables.js') }}" ></script>
    <script src="{{ asset('js/dataTables.bootstrap.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <!-- My own scripts -->
    <script src="{{ asset('js/thingsAppears.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>

  <script>
    function realizaProceso(valor1, valor2){
        var parametros={
            "valor1":valor1,
            "valor2":valor2
        };
        $.ajax({
            data:parametros,
            url: 'datos.php',
            type: 'post',
            beforeSend: function(){
                $("#resultado").html("Procesando,espere..");
            },
            success: function(response){
                $("#resultado").html(response); 
            }
       });
    }
</script>
</head>
@if(Auth:: user()->avatar == "default.png")
   <?php  $url_image = "/images/".Auth:: user()->avatar?>
@else
    <?php $url_image = "/images/uploads/".Auth:: user()->avatar?>
@endif 
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">     
    
    
    @include('layouts.header')
    @include('layouts.main-sidebar')
    <div class="content-wrapper">
      <section class="content">
        @yield('content')  
      </section>
    </div>  

    @include('layouts.footer')

</div>

@yield('specific scripts')  

<script>
    $(function () {
        $('.DataTable').DataTable({
        'paging' : true,
        'lengthChange': false,
        'searching' : true,
        'ordering' : true,
        'info' : false,
        'autoWidth' : false,
        'responsive': true,
        "language": {
            "search": "Buscar",
            "paginate": {
            "previous": "Anterior",
            "next": "Siguiente",
            }
            }
        })
    })
</script> 

</body>
</html>
