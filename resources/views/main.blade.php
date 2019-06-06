@extends('layouts.template')


@section('content')
<style type="text/css">
.mm-left{
    margin-left: 2%;
  }
</style>
   
      <div class="row">
      	<div class="col-md-12">
      	@if( Auth::user()->role == 2) 
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
		      	<div>
		      		<table  class="table table-bordered table-striped mm-left DataTable">
                <thead>
                <tr>
                  <th>Paciente</th>
                  <th>Celular</th>
                  <th>Mensaje</th>
                  <th>Tipo</th>
                  <th>Fecha de llamada</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                	<?php foreach ($tcalls as $tc): ?>
                    <tr>  
                    @if($tc['name']!= "")
                    <td> {{$tc['name']}}</td>
					@else
					<td>Paciente no registrado</td>
					@endif
                    <td>{{$tc['patient_cell']}}</td>
                    <td>{{$tc['message']}}</td>
                    @if($tc['type'] == 1)
                    <td> cita médica </td>
                    @else
                    <td> emergencia </td>
                    @endif
                    <td>{{$tc['created_at']}}</td>
                    @if($tc['status'])
                    <td> Atendido</td>
					@else
					<td> En espera</td>
					@endif
                    <td> 
                      
                      @if($tc['status'])
                        <button  type="button" class="btn btn-success btn-flat buttonSpace disabled"><i class="fa fa-check-square-o"></i></button>
                      @else  
                        <a href="/tcalls/complete/{{$tc['id']}}" title="Marcar como completado" > <button  type="button" class="btn btn-warning btn-flat buttonSpace"><i class="fa  fa-square-o"></i></button></a>
                       @endif
                      <a href="/tcalls/remove/{{$tc['id']}}" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar esta solicitud ?');"><i class="fa fa-trash"></i></button><a>
                    </td>
                    </tr>            
                 <?php endforeach ?>  
                </tbody>
              </table>
		      	</div>
      		</div>
      		@endif 

          @if( Auth::user()->role == 3) 
          <div class="box cp">
            <div class="box-body ">
              <div class="col-md-3" >
                <img src="/images/ambulance.png" style="width: 100%;">
              </div>
              <div class="col-md-3" style="margin-top: 40px;">
                <a href="/patients/new_inbox_emergency">  
                    <button class="callout callout-danger margin">
                     <h2 ><i class="fa fa-plus"></i>  Emergencia</h2>
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
                <a href="#"> 
                     <button class="callout callout-info margin">
                     <h2><i class="fa fa-plus"></i>  Cita Médica </h2>
                    </button>
                  </a>
               </div>   
               <div class="col-md-6 callout callout-info" style="margin-top: 60px;">
                <h4>Que es una cita programada?</h4>

                <p>Insertar aqui la definicion de cita</p>
              
              </div>
              
            </div>
            </div>
            @endif
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