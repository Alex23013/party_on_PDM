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
	        	<h2>Peticiones de historias clínicas</h2>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			<div class="col-xs-12">
			 <table class="table table-bordered table-striped  DataTable">
                <thead>
                <tr>
	                  <th>Código de Atención</th>
	                  <th>Código de Paciente</th>
	                  <th>Nombre del Paciente</th>
	                  <th>Acciones</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($histories as $app): ?>
	                  <tr>  
	                  <td>{{$app['attention_code']}}</td>
	                  <td>{{$app['patient_code']}}</td>
	                  <td>{{$app['patient_name']}}</td>
	                  
	                  <td>
	                  	<a href="/clinic_histories/update_pdf_status_appointment/{{$app['id']}}/2" title="Permitir acceso" > <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa fa-check "></i></button></a>
	                  	
	                  	 <a href="/clinic_histories/update_pdf_status_appointment/{{$app['id']}}/0" title="Denegar acceso" > <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres denegar el acceso a esta petición?');"><i class="fa  fa-close"></i></button><a>
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