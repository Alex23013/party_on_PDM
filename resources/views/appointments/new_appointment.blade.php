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
                                <select class="form-control" name = "specialty_id" >
                                
                                <option value=""> Seleccione una especialidad </option>
                                @foreach($specialties as $specialty)
                                  <option value="<?=$specialty->id?>"><?=$specialty->name?></option>
                                @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="patient_id" class="col-md-4 control-label">Nombre del paciente *</label>

                            <div class="col-md-6">
                                <select class="form-control" name = "patient_user_id" >
                                @if($one)
                                @else
                                <option value=""> Seleccione un paciente </option>
                                @endif
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
                                
                                
                                @if($doctors)
                                <select class="form-control" name = "doctor_user_id" >
                                <option value=""> Seleccione un doctor </option>
                                @foreach($doctors as $doctor)
                                  <option value="<?=$doctor['id']?>"><?=$doctor['name']?></option>
                                @endforeach
                                </select>
                                @else
                                <option value=""> No hay doctores para esta especialidad </option>
                                @endif
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
@endsection