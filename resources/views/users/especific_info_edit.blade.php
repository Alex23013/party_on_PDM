@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
.p-top{
	padding-top: 2%;
}
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
            <div class="box-header row  mm-left">
              <h3 class="box-title col-md-3 p-top" id="Title"> Información adicional de {{$user['name_role']}}:<br>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  mm-left">
            	<div class="row">
	            	<div class="col-md-8">
	            		<form class="form-horizontal" role="form" method="POST" action="/users/especific/edit">
		                {{ csrf_field() }}	
		                @if ($user -> role == 2)
		                <div class="form-group">
                            <label for="is_a_doctor" class="col-md-4 control-label"> Es médico </label>

                            <div class="col-md-6">
                                <input type="radio" name="is_a_doctor" value=1 > Si 
                                <input type="radio" name="is_a_doctor" value=0 checked> No<br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="college" class="col-md-4 control-label">Colegiaturas </label>

                            <div class="col-md-6">
                                <input id="college" type="text" class="form-control" name="college" placeholder="<?=$s_user->college?>" >
                                separadas por '/ ' si tiene más de una
                            </div>
                        </div>
                        @else
                        <!--$s_user can't modify is birthday date 
                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Fecha de Nacimiento : {{$s_user->birth_at}} </label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="birth_at" >
                            </div>
                        </div>-->
                        @if ($user -> role == 1)
                        <!--$s_user is a Doctor -->
                        <div class="form-group">
                            <label for="college" class="col-md-4 control-label">Colegiaturas </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="college" 
                                @if ($s_user->college)
                                placeholder = "{{$s_user->college}}"
                                @else
                                placeholder = "no tiene colegiatura"
                                @endif
                                >
                                separadas por '/ ' si tiene más de una
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Dirección </label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" placeholder="{{$s_user->address}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Especialidad </label>

                            <div class="col-md-6">
                                <input id="specialty" type="text" class="form-control" name="specialty" 
                                @if ($s_user->specialty)
                                placeholder = "{{$s_user->specialty}}"
                                @else
                                placeholder = "médico general"
                                @endif
                                >
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="col-md-8 control-label">Información de contacto de Emergencia (opcional) </label>
                        </div>

                        <div class="form-group">
                            <label for="ec_name" class="col-md-4 control-label">Nombre del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_name" type="text" class="form-control" name="ec_name" placeholder = "{{$s_user->ec_name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ec_last_name" class="col-md-4 control-label">Apellido del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_last_name" type="text" class="form-control" name="ec_last_name" placeholder = "{{$s_user->ec_last_name}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ec_cellphone" class="col-md-4 control-label">Celular del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_cellphone" type="text" class="form-control" name="ec_cellphone" placeholder = "{{$s_user->ec_cellphone}}">
                            </div>
                        </div>

		                @endif
		                <div class="col-md-8 p-top"> 
		                <button type="submit" class="btn   btn-success m-left">  <i class="fa fa-save"></i>  Guardar cambios</button>
		                <a href="/profile"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button> </a>
		                </div>
		                </form>	
	            	</div>	            	
	            	
	            	<div class="col-md-4">
			            <img src="/images/triaje.png" style="width:200px; height:200px;">
			            <br>
			        </div>
	            </div>
            </div>
      <!-- /.box-body -->
    </div>
  </div>
</div> 
@endsection
@section('specific scripts')
<script>
  $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    })
</script>

@endsection
