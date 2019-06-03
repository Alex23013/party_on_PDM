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
	          <h2>Lista de Asociados</h2>
	          <br>
	          @if (Auth::user()->role == 0)
	          <a href="/partners/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir un Asociado</h5>
                </button>
              </a>
              @endif
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4>Nuevo asociado añadido </h4>
			  </div>
			@endif
			 <table class="table table-bordered table-striped mm-left">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Sector</th>
	                  <th>Razón Social</th>
	                  <th>RUC</th>
	                  <th>Celular 1</th>
	                  
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
	                  <tr>  
	                  <td><?=$user->partner_name?></td>
	                  <td><?=$user->sector?></td>
	                  <td><?=$user->social_reason?></td>
	                  <td><?=$user->ruc?></td>
	                  <td><?=$user->cell_1?></td>
	                  <td>
	                  <a href="/partners/detail/{{$user->id}}" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>

	                  @if (Auth::user()->role == 0)
	                  	<a href="/partners/remove/{{$user->id}}" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar este asociado?');"><i class="fa fa-trash"></i></button><a>
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