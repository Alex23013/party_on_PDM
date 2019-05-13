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
	          <h3 class="box-title ">Lista de Pacientes</h3>
	          <a href="/patients/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir un Paciente</h5>
                </button>
              </a>
	        </div>
	        <div class="box-body mm-left"> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h3><b>Nuevo paciente añadido </b></h3>
			    <h5><b><?=$new['name']?> </b></h5>
			  </div>
			@endif
			 <table class="table table-bordered table-striped">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Apellido</th>
	                  <th>DNI</th>
	                  <th>Celular</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
	                  <tr>  
	                  <td><?=$user->name?></td>
	                  <td><?=$user->last_name?></td>
	                  <td><?=$user->dni?></td>
	                  <td><?=$user->cellphone?></td>	                  
	                  <td> 
	                  <a href="/patients/detail/{{$user->id}}"> <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
	                  
	                  <a href="/patients/edit/{{$user->id}}"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  
	                  @if(Auth::user()->role == 0)
	                  <a href="/patients/remove/{{$user->id}}"> <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este paciente?');"><i class="fa fa-trash"></i></button><a>
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