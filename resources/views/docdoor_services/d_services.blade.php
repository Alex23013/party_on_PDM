@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
</style>

<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
	        <div class="box-header mm-left ">
	          <h3 class="box-title ">Lista de Solicitudes de Servicios Docdoor</h3>
	          <br>
	          <a href="/d_services/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-plus"></i>  Añadir una Solicitud</h5>
                </button>
              </a>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body mm-left"> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3><b>Nueva solicitud </b></h3>
			  </div>
			@endif
			 <table class="table table-bordered table-striped">
                <thead>
                <tr>
	                  <th>Paciente</th>
	                  <th>Servicio</th>
	                  <th>Asociado</th>
	                  <th>Direccion inicio</th>
	                  <th>Direccion fin</th>
	                  <th>Estado</th>
	            </tr>
                </thead>
                <tbody>
          		<?php foreach ($services as $d_service): ?>
	                  <tr>  
	                  <td><?=$d_service->name?></td>
	                  <td><?=$d_service->service_name?></td>
	                  <td><?=$d_service->partner_name?></td>
	                  <td><?=$d_service->address_from?></td>
	                  <td><?=$d_service->address_to?></td>
	                  @if ($d_service->complete)
	                  	<td>Realizado</td>
	                  @else
	                  	<td>Pendiente </td>
	                  @endif
	                  <td> 
	                  	<a href="/d_services/detail/{{$d_service->d_service_id}}"> <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>

	                  	@if ($d_service->complete)
	                  		<button  type="button" class="btn btn-success btn-flat buttonSpace disabled"><i class="fa fa-check-square-o"></i></button>
	                  	@else
	                  		<a href="/d_services/{{$d_service->d_service_id}}/complete"> <button  type="button" class="btn btn-warning btn-flat buttonSpace"><i class="fa  fa-square-o"></i></button></a>
	                  	@endif
	                  	<a href="/d_services/remove/{{$d_service->d_service_id}}"> <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar esta solicitud de servicio Docdoor?');"><i class="fa fa-trash"></i></button><a>
	                  </td>
	                  </tr>  
	                  <?php endforeach ?>  
                  
                </tbody>
              </table>
	        </div>
            <!-- /.box-body -->
        </div>
  	</div>
</div>
@endsection