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
                                  <option value="{{$specialty->id}}"><?=$specialty->name?></option>
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
                                <i class="fa fa-user-plus"></i> Registrar un nuevo paciente
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
                                 id = "doctor_select"
                                class="form-control"
                                  name="doctor_user_id">
                                </select>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-md-10 col-md-offset-4">Horario semanal</label>
                        </div>
                        <div class="form-group" >
                            <div class="col-md-10" id= "location" style="margin-left: 20px">   
                          
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Fecha de la cita * </label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="date" >
                                <div id="responseDate">  </div>
                            </div>
                        </div> 

                        
                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Hora de la cita * </label>
                            <div class="col-md-6">
                            <div class="bootstrap-timepicker">
                             <input id="input_time" type="text" class="form-control timepicker" name="time" >
                             <div id="responseTime"> </div>
                            </div>
                            <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>
                         

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="submit_button" name="registrar" value = "1">
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
      format: 'yyyy-mm-dd'
    })

    }); 
</script>
<script>
    
    var submit_button = document.getElementById("submit_button");

    var input_date = document.getElementById("datepicker");
    input_date.disabled=true;

    var input_time = document.getElementById("input_time");
    input_time.disabled=true;

    $('#specialty_selector').change(function(){
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
                console.log("response: ",response);
                $("#resultado").html(response); 
                 var doctorSelect= document.getElementById('doctor_select');
                $(doctorSelect).empty();
                $(doctorSelect).append('<option value=""> Seleccione un doctor</option>')
                for (var i = 0; i < response.length; i++) {
                    $(doctorSelect).append('<option data-horario=\''+response[i].schedule+'\' value="' + response[i].id + '">' + response[i].name + '</option>');
                }                
            }
       });
    })

    $('#datepicker').change(function(){
        $("#responseDate").empty()
        $("#responseDate").append("Comprobando cita...")
        console.log("input-date",$('#datepicker').val())
        console.log("input-user_id",$('#doctor_select').find(':selected').val())
        console.log("input-esp_id",$('#specialty_selector').find(':selected').val())
        var parametros={
                "input_date":$('#datepicker').val(),
                "input_user_id":$('#doctor_select').find(':selected').val(),
                "input_esp_id":$('#specialty_selector').find(':selected').val(),
            };
        $.ajax({
                data: parametros,
                url: '/ajax_validate_date',
                type: 'post',
                success: function(response){
                    console.log("message_response",response);
                    $("#responseDate").empty()
                    
                    if(response == 1){
                        $("#responseDate").append("<i class=\"fa fa-check\"></i> Fecha válida")
                        input_time.disabled=false;
                        submit_button.classList.remove("disabled");
                    }else{
                        $("#responseDate").append("<i class=\"fa fa-times\"></i> ")
                        $("#responseDate").append(response)
                        input_time.disabled=true;
                        submit_button.classList.add("disabled");
                    }
                    
                }
            });
    })

    $('#input_time').change(function(){
        $("#responseTime").empty()
        
        console.log("T input-time",$('#input_time').val())
        console.log("T input-user_id",$('#doctor_select').find(':selected').val())
        console.log("T input-esp_id",$('#specialty_selector').find(':selected').val())
        var parametros={
                "input_date":$('#datepicker').val(),
                "input_time":$('#input_time').val(),
                "input_user_id":$('#doctor_select').find(':selected').val(),
                "input_esp_id":$('#specialty_selector').find(':selected').val(),
            };
        if(input_date.disabled){
            input_time.disabled=true;
        }else{
            $("#responseTime").append("Comprobando cita...")
            $.ajax({
                data: parametros,
                url: '/ajax_validate_time',
                type: 'post',
                success: function(response){
                    console.log("T message_response",response);
                    $("#responseTime").empty()
                    
                    if(response == 1){
                        $("#responseTime").append("<i class=\"fa fa-check\"></i> Hora válida")
                        submit_button.classList.remove("disabled");
                    }else{
                        $("#responseTime").append("<i class=\"fa fa-times\"></i> ")
                        $("#responseTime").append(response)
                        submit_button.classList.add("disabled");
                    }
                    
                }
            });

        }
        
    })
    
    $('#doctor_select').change(function(){
        input_date.disabled=false;
        var specialty_id = $('#specialty_selector').find(':selected').val();
        console.log("specialty_id", specialty_id);
        if(specialty_id == 1){
            console.log("horario ",$("#doctor_select option:selected").data('horario'));
            var horario= $("#doctor_select option:selected").data('horario');

            $("#location").empty()
            $("#location").append("<table class=\"table table-striped \">"+"<thead>"+"<tr>"+
                    "<th>Dia</th>"+
                    "<th>Inicio</th>"+
                    "<th>Fin</th>"+
                    "</tr></thead><tbody id =\"location1\">"   
                )
    
            for (var i = 0; i < horario.length; i++) {
            $("#location1").append(
                    "<tr>"
                        +"<td>"+horario[i].day+"</td>"
                        +"<td>"+horario[i].schedule_start+"</td>"
                        +"<td>"+horario[i].schedule_end+"</td>"
                    +"</tr>" )
                }        
           $("#location").append("</tbody> </table>");    
        }else{
            console.log("Imprimir calendar")
            $("#location").empty()
            $("#location").append("<div id=\"calendar1\" class=\"padding-border-table\">"+"</div>")
            var parametros={
                "val1":$('#doctor_select').find(':selected').val(),
            };
            console.log("paramEvents: user_id->",parametros);
            $.ajax({
                data: parametros,
                url: '/ajax_get_events_by_user_id',
                type: 'post',
                success: function(response){
                    console.log("events_response",response);
                    var events_response = response;  
                    $('#calendar1').fullCalendar({
                      header    : {
                        left  : 'prev,next today',
                        center: 'title',
                        right : 'month,agendaWeek,agendaDay'
                      },
                      buttonText: {
                        today: 'hoy',
                        month: 'mes',
                        week : 'semana',
                        day  : 'dia'
                      },
                      events    :  events_response,
                    })              
                }
            });

         }
    })
</script>
@endsection
    