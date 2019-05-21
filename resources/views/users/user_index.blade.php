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
	          <h2>Lista de Miembros</h2>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			@if ($newUser)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4>Nuevo miembro añadido</h3>
			    <h4><b><?=$newUser['name']?> </b> en el rol de <?=$newUser['name_role']?></h4>
			  </div>
			@endif
			 <table class="table table-bordered table-striped mm-left">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Apellido</th>
	                  <th>DNI</th>
	                  <th>Celular</th>
	                  <th>Email</th>
	                  <th>Rol</th>
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
	                  <td><?=$user->email?></td>
	                  <td><?=$user->name_role?></td>
	                  @if ($user->validated)
	                  	<td>Activo</td>
	                  @else
	                  	<td>Desactivo </td>
	                  @endif
	                  
	                  <td> 
	                  <a href="/users/see/{{$user->id}}"> <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
	                  @if($user->role == 0)
	                  	<a href="#"> <button  type="button" class="btn btn-info btn-flat disabled buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  	@if ($user->validated)
	                  		<a href="#"> <button  type="button" class="btn btn-success disabled btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@else
	                  		<a href="#"> <button  type="button" class="btn btn-warning disabled btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@endif

	                  	<a href="#"> <button  type="button" class="btn btn-danger btn-flat disabled buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este usuario?');"><i class="fa fa-trash"></i></button></a>
	                  @else
	                  	@if ($user->role == 1 || $user->role == 2 ) 
	                  		<a href="/users/edit/{{$user->id}}"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  	@else
	                  		<a href="#"> <button  type="button" class="btn btn-info btn-flat disabled buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  	@endif
	                  	@if ($user->validated)
	                  		<a href="/users/{{$user->id}}/deactive"> <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@else
	                  		<a href="/users/{{$user->id}}/active"> <button  type="button" class="btn btn-warning btn-flat buttonSpace"><i class="fa fa-power-off"></i></button></a>
	                  	@endif
	                  	<a href="/users/remove/{{$user->id}}"> <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este usuario?');"><i class="fa fa-trash"></i></button><a>
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