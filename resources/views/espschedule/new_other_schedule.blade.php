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
                    <form class="form-horizontal" role="form" method="POST" action="/edoctors/schedule/other/add">
                         {{ csrf_field() }}
                        
                         <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Especialidad *</label>

                             <div class="col-md-5" style="
                                margin-left:20px;
                                 background-color: {{$color}}; border-radius: 10px;">                      
                                {{$specialty_name}} 
                            </div>
                            <input type="hidden" name="specialty_id" value = 
                            {{$specialty_id}}> 
                            <input type="hidden" name="specialty_name" value = 
                            {{$specialty_name}}>
                        </div>

                        <div class="form-group">
                            <label for="user_id" class="col-md-4 control-label">Doctor *</label>

                            <div class="col-md-6" style="
                                margin-left:20px;"">
                                {{$doctor_name}}
                                <input type="hidden" name="doctor_id" value = 
                         {{$doctor_id}}>
                         <input type="hidden" name="doctor_name" value = 
                         {{$doctor_name}}>
                            </div>
                        </div>
                        
                         
                         

                        <div class="form-group">
                            <label for="dni" class="col-md-4 control-label">Fecha *</label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="date" >
                                <div id="responseDate">  </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="start_time" class="col-md-4 control-label">Hora Inicio *</label>

                            <div class="col-md-6">
                                <div class="bootstrap-timepicker">
                             <input id="input_start_time"  class="form-control timepicker" name="start_time" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end_time" class="col-md-4 control-label">Hora Fin *</label>

                            <div class="col-md-6">
                                <div class="bootstrap-timepicker">
                                <input id="input_end_time"  class="form-control timepicker" name="end_time" >
                                </div>
                                <div id="responseTime">  </div>
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3 ">
                                <button type="submit" class="btn btn-primary sub" id = "submit_button" name = "guardar" value =0 "">
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

    var input_end_time = document.getElementById("input_end_time");
    input_end_time.disabled=true;
    var input_start_time = document.getElementById("input_start_time");
    input_start_time.disabled=true;
    var submit_button = document.getElementById("submit_button");

    $('#datepicker').change(function(){
        
        $("#responseDate").empty()
        $("#responseDate").append("Validando fecha...")
        var parametros={
                "input_date":$('#datepicker').val()
            };
        $.ajax({
                data: parametros,
                url: '/ajax_validate_date_future',
                type: 'post',
                success: function(response){
                    console.log("message_response",response);
                    $("#responseDate").empty()
                    
                    if(response == 1){
                        $("#responseDate").append("<i class=\"fa fa-check\"></i> Fecha válida")
                        input_start_time.disabled=false;
                        submit_button.classList.remove("disabled");
                    }else{
                        $("#responseDate").append("<i class=\"fa fa-times\"></i> ")
                        $("#responseDate").append(response)
                        submit_button.classList.add("disabled");
                    }
                    
                }
            });
    })

    $('#input_start_time').change(function(){
        input_end_time.disabled=false;
        $("#responseTime").empty()
      $("#responseTime").append("Validando hora...")
      var parametros={
                "start_time":$('#input_start_time').val(),
                "end_time":$('#input_end_time').val()
            };
      $.ajax({
                data: parametros,
                url: '/ajax_validate_time_interval',
                type: 'post',
                success: function(response){
                    console.log("message_response",response);
                    $("#responseTime").empty()
                    
                    if(response == 1){
                        $("#responseTime").append("<i class=\"fa fa-check\"></i> Horario válido")
                        input_start_time.disabled=false;
                        submit_button.classList.remove("disabled");
                    }else{
                        $("#responseTime").append("<i class=\"fa fa-times\"></i> ")
                        $("#responseTime").append(response)
                        submit_button.classList.add("disabled");
                    }
                    
                }
            });
    })
    $('#input_end_time').change(function(){
      $("#responseTime").empty()
      $("#responseTime").append("Validando hora...")
      var parametros={
                "start_time":$('#input_start_time').val(),
                "end_time":$('#input_end_time').val()
            };
      $.ajax({
                data: parametros,
                url: '/ajax_validate_time_interval',
                type: 'post',
                success: function(response){
                    console.log("message_response",response);
                    $("#responseTime").empty()
                    
                    if(response == 1){
                        $("#responseTime").append("<i class=\"fa fa-check\"></i> Horario válido")
                        input_start_time.disabled=false;
                        submit_button.classList.remove("disabled");
                    }else{
                        $("#responseTime").append("<i class=\"fa fa-times\"></i> ")
                        $("#responseTime").append(response)
                        submit_button.classList.add("disabled");
                    }
                    
                }
            });
    })
 }); 
</script>
@endsection