@extends('layouts.template')


@section('content')
<style type="text/css">
.mm-left{
    margin-left: 2%;
  }
#message_type{
	visibility: hidden;
}
</style>
   
<div class="row">
	<div class="col-md-12"> 
		@if($message)
		<div class="alert alert-success alert-dismissible pTop" role="alert">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    <h3>{{$message['title']}}</h3>
		  	<h4>{{$message['content']}}</h4>
		  	<span id = "message_type">{{$message['type']}}</span>
		</div>	
		<script>
		  var socket = io('http://127.0.0.1:3030');
		  	var a = $("#message_type").html();
	      a = parseInt(a);
	      
		    socket.on('connect',function(){
		      console.log("connected22 socket");
		      $json = {
		        "id": socket.id,
		        "data": a,
		      }
		      socket.emit('send', $json);
		    });
		</script>
		@endif  
	  <div class="box">
	    <div class="box-body ">
	      <div class="col-md-3" >
	        <img src="/images/ambulance.png" style="width: 100%;">
	      </div>
	      <div class="col-md-3" style="margin-top: 40px;">
	        <a href="/patients/new_inbox_emergency">  
	            <button class="callout callout-danger margin">
	             <h3 ><i class="fa fa-plus"></i>  Emergencia</h3>
	            </button>
	          </a>
	      </div>
	      <div class="col-md-6 callout callout-danger" style="margin-top: 60px;">
	           <h4>Que es una Emergencia?</h4>

	        <p>Insertar aqui la definicion de emergencia</p>
	      
	      </div>
	    </div>
	  </div>     
	  <div class="box">
	    <div class="box-body " style="padding-top: 20px;">
	      <div class="col-md-3">
	      <img src="/images/medic_date.png" style="width: 100%;"></div>
	      <div class="col-md-3" style="margin-top: 40px;">
	        <a href="/patients/new_inbox_appointment"> 
	             <button class="callout callout-info margin">
	             <h3><i class="fa fa-plus"></i>  Cita Médica </h3>
	            </button>
	          </a>
	       </div>   
	       <div class="col-md-6 callout callout-info" style="margin-top: 60px;">
	        <h4>Que es una cita programada?</h4>

	        <p>Insertar aqui la definicion de cita</p>
	      
	      </div>
	      
	    </div>
	    </div>
	</div>
</div>

	
@endsection


@section('specific scripts')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@endsection