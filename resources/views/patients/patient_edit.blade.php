@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
.p-top{
	padding-top: 2%;
}
.m-left{
	margin-left: 3%;
}
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
            <div class="box-header row  mm-left">
              <h3 class="box-title col-md-3 p-top" id="Title"> Información del Paciente:<br>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  mm-left">
            	<div class="row">
	            	<div class="col-md-8">
	            		<form class="form-horizontal" role="form" method="POST" action="/patients/edit">
		                {{ csrf_field() }}	  
		                <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-md-2 control-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" placeholder="{{$user->last_name}}" >
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="cellphone" class="col-md-2 control-label">Celular </label>

                            <div class="col-md-6">
                                <input id="cellphone" type="text" class="form-control" name="cellphone" placeholder="{{$user->cellphone}}">
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="cellphone" class="col-md-2 control-label">Email </label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="{{$user->email}}">
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 control-label">Información de contacto de Emergencia (opcional) </label>
                        </div>

                        <div class="form-group">
                            <label for="ec_name" class="col-md-2 control-label">Nombre del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_name" type="text" class="form-control" name="ec_name" placeholder = "{{$patient->ec_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ec_last_name" class="col-md-2 control-label">Apellido del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_last_name" type="text" class="form-control" name="ec_last_name" placeholder = "{{$patient->ec_last_name}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ec_cellphone" class="col-md-2 control-label">Celular del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_cellphone" type="text" class="form-control" name="ec_cellphone" placeholder = "{{$patient->ec_cellphone}}">
                            </div>
                        </div>
                         <input id="id" type="hidden" name="id" value = 
                         {{$user->id}}>
                         <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>    Guardar cambios  </button>                                  
			            </form>
			            <br>
			            <a href="/patients"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
			        </div>
	            </div>
            </div>
      <!-- /.box-body -->
    </div>
  </div>
</div> 
@endsection