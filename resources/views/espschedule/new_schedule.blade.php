 @extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar un Horario</div>
                <div class="panel-body">
                @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                @endif
                    <form class="form-horizontal" role="form" method="POST" action="">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Especialidad *</label>

                             <div class="col-md-6">                      
                                <select class="form-control" name = "specialty_id" id="specialty_select" >
                                <option value="">Seleccione una especialidad</option>
                                @foreach($specialties as $specialty)
                                  @if($specialty->id == 1)
                                  @else
                                  <option value="{{$specialty->id}}"><?=$specialty->name?></option>
                                  @endif
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_id" class="col-md-4 control-label">Doctor *</label>

                            <div class="col-md-6">
                                <select
                                 id = "chooseDoctor"
                                class="form-control"
                                name = "user_id">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dni" class="col-md-4 control-label">Fecha *</label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="date" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_time" class="col-md-4 control-label">Hora Inicio *</label>

                            <div class="col-md-6">
                                <div class="bootstrap-timepicker">
                             <input id="start_time"  class="form-control timepicker" name="start_time" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end_time" class="col-md-4 control-label">Hora Fin *</label>

                            <div class="col-md-6">
                                <div class="bootstrap-timepicker">
                             <input id="end_time"  class="form-control timepicker" name="end_time" >
                                </div>
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-md-4 control-label">Color</label>
                             
                            <div class="col-md-6 btn-group">
                                <ul class="fc-color-picker" id="color-chooser">
                                  <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                </ul>
                            </div>
                              <input id="input-color" type="hidden" name="color">
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3 ">
                                <button type="submit" class="btn btn-primary sub" name = "guardar" value =0 "">
                                    <i class="fa fa-btn fa-save"></i> Guardar Horario
                                </button>
                            </div>

                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary sub" name = "guardar" value = "1">
                                    <i class="fa fa-btn fa-calendar-plus-o"></i> Guardar y Agregar otro Horario
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 col-md-offset-4">
                              <a href="/edoctors/schedule">  
                                <button class="btn btn-danger">
                                    <i class="fa fa-times"></i> Descartar Cambios
                                </button>
                              </a>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('specific scripts')
<script type="text/javascript" >
    $(function () {

    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showSeconds:false,
      showMeridian:false
    })

	$('#color-chooser > li > a').click(function (e) {
	      e.preventDefault()
	      //Save color
	      currColor = $(this).css('color')
	      //Add color effect to button
	      $('.sub').css({ 'background-color': currColor, 'border-color': currColor });
	      $('#input-color').val(currColor);
	       console.log(currColor)
	    })

  function chooseSpecialty(){
        var parametros={
            "valor1":$('#specialty_select').find(':selected').val(),
        };
        console.log(parametros);
        $.ajax({
            data: parametros,
            url: '/ajax_get_doctors_per_specialty',
            type: 'post',
            beforeSend: function(){
                $("#resultado").html("Procesando,espere..");
            },
            success: function(response){
                console.log(response);
                 var chooseDoctor= document.getElementById('chooseDoctor');
                $(chooseDoctor).empty();
                $(chooseDoctor).append('<option value=""> Seleccione un doctor </option>')
                for (var i = 0; i < response.length; i++) {
                    $(chooseDoctor).append('<option value="' + response[i].id + '">' + response[i].name + '</option>');
                }                
            }
       });
    }

    $('#specialty_select').change(function(){
        console.log($("#specialty_select option:selected"));
        chooseSpecialty();
    })

 }); 
</script>
@endsection