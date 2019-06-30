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
              <h3 class="box-title col-md-3 p-top" id="Title"> Datos del Técnico:<br>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  mm-left">
            	<div class="row">
	            	<div class="col-md-8">
	            		<form class="form-horizontal" role="form" method="POST" action="/techs/edit">
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
                            <label for="dni" class="col-md-2 control-label">DNI</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" placeholder="{{$user->dni}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cellphone" class="col-md-2 control-label">Celular </label>

                            <div class="col-md-6">
                                <input id="cellphone" type="text" class="form-control" name="cellphone" placeholder="{{$user->cellphone}}">
                            </div> 
                        </div>
                         <input id="id" type="hidden" name="id" value = 
                         {{$user->id}}>
                         <div class="col-md-8 col-md-offset-2">
                         <button type="submit" class="btn  btn-flat btn-success m-left col-md-7">  <i class="fa fa-save"></i>    Guardar cambios  </button>
                         </div>                                  
			            </form>
			            <br>
                  <div class="col-md-8 col-md-offset-2" style="margin-top: 10px;">
                    <a href="/techs"> <button class=" btn  btn-flat btn-danger m-left col-md-7">  <i class="fa fa-close"></i> Descartar cambios</button></a>  
                  </div>
			        </div>
	            </div>
            </div>
      <!-- /.box-body -->
    </div>
  </div>
</div> 
@endsection