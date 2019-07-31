
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://checkout.culqi.com/js/v3"></script>

<style type="text/css">
  @font-face {
    font-family: "font_gothamBook";
    src: url("fonts/GothamMedium.woff") format('woff');
    /*src: url("fonts/GothamBook.woff") format('woff');*/
    }
  #alertsuccess{
    font-family: font_gothamBook, sans-serif;
    background-color: #00a65a;
    color: #fff;
    border-radius: 3px;
    margin: 20px;
    padding: 20px;
  }
  
</style>
<div id="alertsuccess"> Procesando pago ... </div>

<script type="text/javascript" >
$( document ).ready(function() {
	 Culqi.publicKey = 'pk_test_4AOuYFleZVAvrn41';
    //alert( "ready!" );
    descp = "remera";// $(this).attr('data-description');
    cost = "300";//$(this).attr('data-cost')*100;

    Culqi.settings({
        title: "DocDoor services",
        currency: 'PEN',
        description: descp ,
        amount: cost,
      });
    Culqi.open();

    
});
function culqi() {
      if (Culqi.token) { // ¡Objeto Token creado exitosamente!
          var token = Culqi.token.id;
          var email = Culqi.token.email;
          console.log('Se ha creado un token:' + token);
          var data = {descp: descp , cost: cost, token_pay: token, email: email};

          $.ajax({
            data: data,
            url: '/patients/payment_app/',
            type: 'post',
            success: function(response){
              console.log("response:");
                console.log(response);
                $("#alertsuccess").empty();
                $("#alertsuccess").append('<div class="alert alert-success alert-dismissible pTop" role="alert">'+"<h3>Pago Realizado</h3><h4>"+response+"</h4>"+"</div>");         
            },
            error:function(er){
              console.log("error:");
                console.log(er);        
            }

       });
          console.log("end_culqi");

      } else { // ¡Hubo algún problema!
          // Mostramos JSON de objeto error en consola
          console.log(Culqi.error);
          alert(Culqi.error.user_message);
      }
    };
</script>