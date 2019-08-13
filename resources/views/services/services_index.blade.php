 @extends('layouts.template')

@section('content')

<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
	        <div class="box-header mm-left ">
	          <h2>Lista de Servicios</h2>
	          <br>
	          <a href="/services/add/0">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir un Servicio</h5>
                </button>
              </a>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4>Nuevo servicio añadido </h4>
			  </div>
			@endif
			<div class="col-xs-12">
			 <table class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>N° Asociados</th>
	                  <th>Acciones</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($services as $esp): ?>
                	
	                  <tr>  
	                  <td>{{$esp['name']}}</td>
	                  <td>{{$esp['num_doctors']}}</td>
	                  <td> 
	                  	<a href="/services/edit/{{$esp['id']}}" title="Editar"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  	@if($esp['num_doctors'] > 0)
	                  	<a href="#" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace disabled"><i class="fa fa-trash"></i></button><a>
	                 		@else
	                 		<a href="/services/remove/{{$esp['id']}}" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace" onclick="return confirm('¿Estas seguro de que quieres eliminar este Servicio?');"><i class="fa fa-trash"></i></button><a>
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