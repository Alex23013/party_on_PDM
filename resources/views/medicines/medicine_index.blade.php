 @extends('layouts.template')

@section('content')

<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
	        <div class="box-header mm-left ">
	          <h2>Lista de medicamentos</h2>
	          <br>
	          <a href="/medicines/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Añadir medicamentos</h5>
                </button>
              </a>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			@if ($new)
			  <div class="alert alert-success alert-dismissible pTop" role="alert">
			    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			    <b>Nuevo medicamento añadido</b>
			    <h4> {{$new->name}} en {{$new->presentation}} de {{$new->dosis}} </h4>
			  </div>
			@endif
			<div class="col-xs-12">
			 <table class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Grupo</th>
	                  <th>Marca</th>
	                  <th>Dosis</th>
	                  <th>Presentación</th>
	                  <th>Acciones</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($medicines as $med): ?>
                	@if($med['id'] > 2)
	                  <tr>  
	                  <td>{{$med['name']}}</td>
	                  <td>{{$med['group_name']}}</td>
	                  <td>{{$med['brand']}}</td>
	                  <td>{{$med['dosis']}}</td>
	                  <td>{{$med['presentation']}}</td>
	                  <td>                   	
	                 		<a href="/medicines/remove/{{$med['id']}}" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace" onclick="return confirm('¿Estas seguro de que quieres eliminar este medicamento?');"><i class="fa fa-trash"></i></button><a>
	                 		
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