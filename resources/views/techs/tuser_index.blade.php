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
	          <h3 class="box-title ">Lista de Miembros</h3>
	          <a href="/techs/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir un Técnico</h5>
                </button>
              </a>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body mm-left"> 
			@if ($new_tech)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3><b>Nuevo técnico añadido </b></h3>
			  </div>
			@endif
			 <table class="table table-bordered table-striped">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Apellido</th>
	                  <th>DNI</th>
	                  <th>Celular</th>
	                  <th>Estado</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
	                  <tr>  
	                  <td><?=$user->name?></td>
	                  <td><?=$user->last_name?></td>
	                  <td><?=$user->dni?></td>
	                  <td><?=$user->cellphone?></td>
	                  @if ($user->active)
	                  	<td>Activo</td>
	                  @else
	                  	<td>Desactivo </td>
	                  @endif
	                  @if (Auth::user()->role == 0)
	                  <td> 
	                  	<a href="/techs/edit/{{$user->id}}"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>

	                  	@if ($user->active)
	                  		<a href="/techs/{{$user->id}}/deactive"> <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@else
	                  		<a href="/techs/{{$user->id}}/active"> <button  type="button" class="btn btn-warning btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@endif
	                  	<a href="/techs/remove/{{$user->id}}"> <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este técnico?');"><i class="fa fa-remove"></i></button><a>
	                  @endif
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