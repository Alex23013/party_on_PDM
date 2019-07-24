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
	          <h2>Lista de kits</h2>
	          <br>
	          <a href="/kits/create">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir un kit</h5>
                </button>
              </a>
	        </div>
	        <div class="box-body "> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4>Nuevo kit añadido</h4>
			    <h4><b><?=$new['name']?> </b></h4>
			  </div>
			@endif
			<div class="col-xs-12">
			 <table  class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Num Doctores que lo usan</th>
	                  <th>Acciones</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($kits as $kit): ?>
	                  <tr>  
	                  <td><?=$kit->name?></td>
	                  <td><?=$kit->count?></td>                 
	                  <td> 
	                  <a href="/kits/detail/{{$kit->id}}" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
	                  @if($kit->count>0)
	                  	<a href="#" title="Eliminar" >
		                   <button  type="button" class="btn btn-danger btn-flat buttonSpace disabled"><i class="fa fa-trash"></i>
		                   </button>
	                  @else
		                  <a href="/kits/remove/{{$kit->id}}" title="Eliminar" >
		                   <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro que quieres eliminar este paciente?');"><i class="fa fa-trash"></i>
		                   </button>
		                  <a>
	                  @endif
	                  </td>
	                  </tr>  
	                  <?php endforeach ?>  
                  
                </tbody>
              </table>
              </div>
	        </div>
            <!-- /.box-body -->
        </div>
  	</div>
</div>
@endsection