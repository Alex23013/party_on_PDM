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
	          <h2>Lista de Servicios</h2>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4>Nuevo servicio agregado</h4>
			  </div>
			@endif
			<div class="col-xs-12">
			 <table class="table table-bordered table-striped mm-left DataTable">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Costo del servicio</th>
	                  <th>Comision DocDoor</th>
	                  <th>Estado</th>
	            </tr>
                </thead>
                <tbody>
          		<?php foreach ($services as $p_service): ?>
	                  <tr>  
	                  <td><?=$p_service->service_name?></td>
	                  <td><?=$p_service->service_cost?></td>
	                  <td><?=$p_service->docdoor_cost?></td>
	                  @if ($p_service->active)
	                  	<td>Activo</td>
	                  @else
	                  	<td>Desactivo </td>
	                  @endif
	                  <td> 
	                  	<a href="/p_services/{{$id_P}}/edit/{{$p_service->service_id}}/" title="Editar" > <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>

	                  	@if ($p_service->active)
	                  		<a href="/p_services/{{$id_P}}/{{$p_service->id}}/deactive" title="Desactivar"> <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@else
	                  		<a href="/p_services/{{$id_P}}/{{$p_service->id}}/active" title="Activar" > <button  type="button" class="btn btn-warning btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@endif
	                  	<a href="/p_services/remove/{{$id_P}}/{{$p_service->id}}" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este servicio de asociado?');"><i class="fa fa-trash"></i></button><a>
	                  </td>
	                  </tr>  
	                  <?php endforeach ?>  
                  
                </tbody>
              </table>
              </div>
            <a href="/p_services/{{$id_P}}/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-plus"></i>  Añadir un Servicio</h5>
                </button>
              </a>
	        </div>
            <!-- /.box-body -->
        </div>
  	</div>
</div>
@endsection