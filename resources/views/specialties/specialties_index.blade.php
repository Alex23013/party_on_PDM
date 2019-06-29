 @extends('layouts.template')

@section('content')

<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
	        <div class="box-header mm-left ">
	          <h2>Lista de Especialidades</h2>
	          <br>
	          <a href="/specialties/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir una Especialidad</h5>
                </button>
              </a>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <h4>Nueva especialidad añadida </h4>
			  </div>
			@endif
			<div class="col-xs-12">
			 <table class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Color</th>
	                  <th>Acciones</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($specialties as $esp): ?>
                	@if($esp->id != 1)
	                  <tr>  
	                  <td>{{$esp->name}}</td>
	                  <td><div class="col-md-4 " style="border-radius: 10px; background-color: {{$esp->color}};
    						color: {{$esp->color}};"> Color</div></td>
	                  <td> 
	                  	<a href="/specialties/edit/{{$esp->id}}" title="Editar"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  	
	                  	<a href="/specialties/remove/{{$esp->id}}" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar esta especialidad?');"><i class="fa fa-trash"></i></button><a>
	                 
	                  </td>
	                  </tr> 
	                @endif 
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