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
    

    <!-- fullCalendar -->
    <link href="{{ asset('css/calendar/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar/fullcalendar.min.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('css/dataTables.bootstrap.css') }}"  rel="stylesheet" >

    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/_all-skins.min.css') }}" rel="stylesheet">


    <!-- font 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
    
    <!-- Incluyendo Culqi Checkout -->
    <script src="https://checkout.culqi.com/js/v3"></script>

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
    <!-- fullCalendar -->
    <script src="{{ asset('js/calendar/moment.js') }}"></script>
    
    <script src="{{ asset('js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/calendar/es.js') }}"></script>
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
</head>
@if(Auth:: user()->avatar == "default.png")
   <?php  $url_image = "/images/".Auth:: user()->avatar?>
@else
    <?php $url_image = "/images/uploads/".Auth:: user()->avatar?>
@endif 
<style type="text/css">
    .padding-border-table{
        padding-left: 3%;
        padding-right: 3%;
      }
    @font-face {
        font-family: "font_gothamBook";
        /*src: url("fonts/GothamMedium.woff") format('woff');*/
        src: url("fonts/GothamBook.woff") format('woff');
        }
    @font-face {
    font-family: "font_gothamBookItalic";
    src: url("fonts/GothamLight.woff") format('woff');
    }
    .main-header .logo{
      font-family: font_gothamBook, monospace;
      font-display: swap;
      font-size: 14px;
    }
    body {
      font-family: font_gothamBook, monospace;
      font-size: 14px;
      font-display: swap;
    }
    .mm-left{
        margin-left: 2%;
      }
</style>
<body class="hold-transition skin-blue-light sidebar-mini">
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
  Culqi.publicKey = 'pk_test_4AOuYFleZVAvrn41';

  var descp = "";
  var cost = "";

  $('#buyButton').on('click', function(e) {
    descp = $(this).attr('data-description');
    cost = $(this).attr('data-cost')*100;

    Culqi.settings({
        title: "DocDoor services",
        currency: 'PEN',
        description: descp ,
        amount: cost,
      });
    Culqi.open();
    e.preventDefault();
    });

  function culqi() {
      if (Culqi.token) { // ¡Objeto Token creado exitosamente!
          var token = Culqi.token.id;
          var email = Culqi.token.email;
          //alert('Se ha creado un token:' + token);
          var data = {descp: descp , cost: cost, token: token, email: email};
          var url = "/patients/payment";

          $.post(url,data,function(res){
            alert(res);
          });

      } else { // ¡Hubo algún problema!
          // Mostramos JSON de objeto error en consola
          console.log(Culqi.error);
          alert(Culqi.error.user_message);
      }
    };

</script>

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
