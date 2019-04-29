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
	          <h3 class="box-title ">Lista de Servicios</h3>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body mm-left"> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3><b>Nuevo servicio agregado a $id_P </b></h3>
			  </div>
			@endif
			 <table class="table table-bordered table-striped">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Costo del servicio</th>
	                  <th>Costo de docdoor</th>
	                  <th>Estado</th>
	            </tr>
                </thead>
                <tbody>
          		<?php foreach ($services as $p_service): ?>
	                  <tr>  
	                  <td><?=$p_service->name?></td>
	                  <td><?=$p_service->service_cost?></td>
	                  <td><?=$p_service->docdoor_cost?></td>
	                  @if ($p_service->active)
	                  	<td>Activo</td>
	                  @else
	                  	<td>Desactivo </td>
	                  @endif
	                  <td> 
	                  	<a href="#"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>

	                  	@if ($p_service->active)
	                  		<a href="/p_services/{{$id_P}}/{{$p_service->id}}/deactive"> <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@else
	                  		<a href="/p_services/{{$id_P}}/{{$p_service->id}}/active"> <button  type="button" class="btn btn-warning btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@endif
	                  	<a href="/p_services/remove/{{$id_P}}/{{$p_service->id}}"> <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este servicio de asociado?');"><i class="fa fa-remove"></i></button><a>
	                  </td>
	                  </tr>  
	                  <?php endforeach ?>  
                  
                </tbody>
              </table>
            <a href="/techs/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir un Servicio</h5>
                </button>
              </a>
	        </div>
            <!-- /.box-body -->
        </div>
  	</div>
</div>
@endsection