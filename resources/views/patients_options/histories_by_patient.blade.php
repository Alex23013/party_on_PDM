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
	           	<h2>Historial Clínico</h2>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			<div class="col-xs-12">
			 <table class="table table-bordered table-striped  DataTable">
                <thead>
                <tr>
	                  <th>Codigo de atención</th>
	                  <th>Doctor</th>
	                  <th>Fecha</th>
	                  <th>Hora</th>
	                  <th>Acciones</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($matched_histories as $app): ?>
	                  <tr>  
	                  <td>{{$app['attention_code']}}</td>
	                  <td>{{$app['doctor_name']}}</td>
	                  <td>{{$app['date']}}</td>
	                  <td>{{$app['time']}}</td>
	                  
	                  <td>
	                  	<a href="/patients/clinic_history/see/{{$app['id']}}" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
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