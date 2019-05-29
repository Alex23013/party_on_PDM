@extends('layouts.template')


@section('content')
   
      <div class="row">
      	<div class="col-md-12">
	      	<div class="box">
	      		<div class="box-header"></div>
	      		 <div class="box-body ">
	      		 	<div class="col-md-2">
	      		 		<img src="/images/ambulance.png" style="width: 100%;">
	      		 	</div>
			      	<div class="col-md-4">
			      		<a href="/emergency/add">  
		                <button type="button" class="btn  bg-olive margin">
		                 <h2 ><i class="fa fa-plus"></i>  Emergencia</h2>
		                </button>
		              </a>
		              <br>
		              <span> <b>Emergencia:</b> Insertar aqui la definicion de Emergencia/ Urgencia</span>
			      	</div>
			      	<div class="col-md-4">
			      		<a href="/appointments/add"> 
		                 <button type="button" class="btn  bg-purple margin">
		                 <h2><i class="fa fa-plus"></i>  Cita Médica </h2>
		                </button>
		              </a>
		              <br>
		              <span> <b>Cita Programada:</b> Insertar aqui la definicion de cita</span>
			      	</div>
			      	<div class="col-md-2">
			      	<img src="/images/medic_date.png" style="width: 100%;"></div>
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