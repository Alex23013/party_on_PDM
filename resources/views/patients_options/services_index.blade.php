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
	        	<h2>Lista de Servicios Ofertados por DocDoor</h2>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			<div class="col-xs-12 ">
			 <table class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
	                  <th>Nombre del servicio</th>
	                  <th>Ver detalles</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($services as $s): ?>
	                  <tr>  
	                  <td>{{$s->service_name}}</td>
	                  <td>
	                  	<a href="#" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
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