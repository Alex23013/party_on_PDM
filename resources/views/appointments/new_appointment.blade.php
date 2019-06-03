@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar una Cita Médica </div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/appointments">
                         {{ csrf_field() }}
                         
                         <div class="form-group">
                            <label for="specialty" class="col-md-4 control-label">Especialidad *</label>

                            <div class="col-md-6">                      
                                <select class="form-control" name = "specialty_id" id="specialty_selector" >
                                
                                <option value="" selected="selected"> Seleccione una especialidad </option>
                                @foreach($specialties as $specialty)
                                  <option value="{{$specialty->id}}" onclick="chooseSpecialty();return false;"><?=$specialty->name?></option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patient_id" class="col-md-4 control-label">Nombre del paciente *</label>

                            <div class="col-md-6">
                                <select class="form-control" name = "patient_user_id" >
                                <option value=""> Seleccione un paciente </option>
                                @foreach($patients as $patient)
                                  <option value="<?=$patient['id']?>"><?=$patient['name']?></option>
                                @endforeach
                                </select>
                                <a href="/patients/add/1">  
                                <button type="button" class="btn  bg-purple margin">
                                <i class="fa fa-user-plus"></i>
                                </button>
                              </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="motive" class="col-md-4 control-label">Motivo  *</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name = "motive" rows="3" placeholder="Describa el problema"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Dirección *</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" >
                                 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reference" class="col-md-4 control-label">Referencia </label>

                            <div class="col-md-6">
                                <input id="reference" type="text" class="form-control" name="reference" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Información de la cita </label>
                        </div>

                        <div class="form-group">

                            <label for="doctor_id" class="col-md-4 control-label">Doctor *</label>

                            <div class="col-md-6">     
                                <select
                                 id = "chooseDoctor"
                                class="form-control"
                                  name="doctor_user_id">
                                </select>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-4 control-label">Horario semanal</label>
                            <div class="col-md-6">
                                <table class="table table-striped ">
                                <thead>
                                <tr>
                                      <th>Dia</th>
                                      <th>Inicio</th>
                                      <th>Fin</th>
                                </tr>
                                </thead>
                                <tbody id= "location">
                                </tbody>
                          </table>
                          </div>
                        </div>

                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Fecha de la cita * </label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="date" >
                            </div>
                        </div> 

                        
                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Hora de la cita * </label>
                            <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                             <input id="schedule_start" type="text" class="form-control timepicker" name="time" >
                                </div>
                            <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>
                         

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="registrar" value = "1">
                                    <i class="fa fa-btn fa-user"></i> Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('specific scripts')
<script type="text/javascript" >
   $(function () {
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showSeconds: false,
      showMeridian:false
    })

    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    })

    }); 
</script>
<script>
    
    function chooseSpecialty(){
        var parametros={
            "valor1":$('#specialty_selector').find(':selected').val(),
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
                $("#resultado").html(response); 
                 var chooseDoctor= document.getElementById('chooseDoctor');
                $(chooseDoctor).empty();
                $(chooseDoctor).append('<option value=""> Seleccione un doctor</option>')
                for (var i = 0; i < response.length; i++) {
                    $(chooseDoctor).append('<option data-horario=\''+response[i].schedule+'\' value="' + response[i].id + '" onclick="chooseDoctor();return false;" >' + response[i].name + '</option>');
                }                
            }
       });
    }

    function chooseDoctor(){
        var parametros1={
            "valor1":$('#chooseDoctor').find(':selected').val(),
            };
        console.log(parametros1);
    }

    $('#chooseDoctor').change(function(){
        console.log($("#chooseDoctor option:selected").data('horario'));
        var horario= $("#chooseDoctor option:selected").data('horario');

        for (var i = 0; i < horario.length; i++) {
            $("#location").append(
                    "<tr>"
                        +"<td>"+horario[i].day+"</td>"
                        +"<td>"+horario[i].schedule_start+"</td>"
                        +"<td>"+horario[i].schedule_end+"</td>"
                    +"</tr>" )
                }
    })
</script>

@endsection
    