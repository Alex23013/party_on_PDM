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
	        @if($app_status == 2)
	        	<h2>Historial de Citas</h2>
	        @endif
	        @if($app_status == 0)
	        	<h2>Citas por confirmar</h2>
	        @endif
	        @if($app_status == 1)
	        	<h2>Citas confirmadas</h2>
	        @endif
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			<div class="col-xs-12">
			 <table class="table table-bordered table-striped  DataTable">
                <thead>
                <tr>
	                  <th>Doctor</th>
	                  <th>Especialidad</th>
	                  <th>Fecha</th>
	                  <th>Hora</th>
	                  @if($app_status < 2)
	                  <th>Acciones</th>
	                  @else
	                  <th>Estado</th>
	                  @endif
	                  @if($app_status == 2)
	                  <th>Acciones</th>
	                  @endif
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($matched_apps as $app): ?>
	                  <tr>  
	                  <td>{{$app['doctor_name']}}</td>
	                  <td>{{$app['specialty']}}</td>
	                  <td>{{$app['date']}}</td>
	                  <td>{{$app['time']}}</td>
	                  @if($app_status < 2)
	                  <td>
	                  	@if($app_status == 0 )
	                  	<a href="/patients/update_status_appointment/{{$app['id']}}/1" title="Confirmar cita" > <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa  fa-calendar-check-o "></i></button></a>
	                  	@endif
	                  	<a href="/patients/appointment_detail/{{$app['att_id']}}" title="Ver detalles de la cita" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
	                  	 <a href="/patients/update_status_appointment/{{$app['id']}}/3" title="Cancelar cita" > <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres cancelar esta cita');"><i class="fa fa-calendar-times-o "></i></button><a>
	                  </td>
	                  @else
	                  	@if($app['status']==2)
	                  		<td> Atendido </td>
	                  		<td> <a href="/patients/attention_report/{{$app['att_id']}}" title="Solicitar Reporte" > <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa   fa-file-text-o "></i></button></a>
	                  		@if($app['recipe'])
	                  		<a href="/patients/recipe_report/{{$app['att_id']}}" title="Solicitar Receta Medica" > <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa fa-medkit "></i></button></a>
	                  		@endif
	                  		 </td>
	                  		 
	                  	@else
	                  		<td> Cancelado </td>
	                  	@endif	
	                  @endif
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