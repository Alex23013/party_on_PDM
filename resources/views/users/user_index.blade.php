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
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body mm-left"> 
			@if ($newUser)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3><b>Nuevo miembro añadido </b></h3>
			    <h5><b><?=$newUser['name']?> </b> en el rol de </h5>
			  </div>
			@endif
			 <table class="table table-bordered table-striped">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Email</th>
	                  <th>Rol</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
	                  <tr>  
	                  <td><?=$user->name?></td>
	                  <td><?=$user->email?></td>
	                  <td><?=$user->role?></td>
	                  <td> <a href="#"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  @if($user->role == 0)
	                  	<a href="#"> <button  type="button" class="btn btn-danger btn-flat disabled buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este usuario?');"><i class="fa fa-remove"></i></button></a>
	                  @else
	                  	<a href="#"> <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este usuario?');"><i class="fa fa-remove"></i></button></a>
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