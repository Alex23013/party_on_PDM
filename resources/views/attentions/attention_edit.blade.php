@extends('layouts.template')

@section('content')
<style type="text/css">
  .p-left{
    padding-left: 5%;
  }
  .p-top{
    margin-top: 1%;
  }
  .m-left{
    margin-top: 10px;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body p-left">
        <h3> Información de la Cita Médica</h3>
        <form class="form-horizontal" role="form" method="POST" action="/appointments/edit">
      <br>
      <div class="col-md-8">
        <div class="col-md-12" >
          <label class="col-md-2"> Motivo: </label>
          <div  class="col-md-8">
              <textarea class="form-control" name = "motive" rows="2" placeholder="Describa el problema"></textarea>
          </div>
        </div>

        <div class="col-md-12 p-top" >
          <label class="col-md-2"> Dirección: </label>
          <div class="col-md-8">
              <input id="address" type="text" class="form-control" name="address" placeholder="{{$attention->address}}">
          </div>
        </div>

        <div class="col-md-12 p-top" >
          <label class="col-md-2"> Referencia: </label>
          <div class="col-md-8">
              <input id="reference" type="text" class="form-control" name="reference" placeholder="{{$attention->reference}}">
          </div>
        </div>

        <div class="col-md-12 p-top" >
            <h4>
              <label class="col-md-11 subtitle">Detalles de la cita médica</label>
            </h4>
          </div>

          <div class="col-md-12 p-top" >
            <label class="col-md-2"> Doctor: </label>
            <div class="col-md-8">
            @if($doctors)
              <select class="form-control" name = "doctor_id" >
              <option value="{{$s_attention->doctor_id }}">{{ $user_doctor->name }} (Actual doctor) </option>
              @foreach($doctors as $doctor)
                <option value="<?=$doctor['id']?>"><?=$doctor['name']?></option>
              @endforeach
              </select>
              @else
              <option value=""> No hay doctores para esta especialidad </option>
              @endif
            </div>
          </div>

          <div class="col-md-12 p-top" >
            <label class="col-md-2"> Fecha: </label>
            <div class="col-md-8">
                <input id="datepicker" type="text" class="form-control" name="date" placeholder="{{$intervals[0]}}">
            </div>
          </div>
          <div class="col-md-12 p-top" >
            <label class="col-md-2"> Hora: </label>
            <div class="bootstrap-timepicker col-md-8">
             <input id="schedule_start" type="text" class="form-control timepicker" name="time" placeholder="{{$intervals[1]}}">
            </div>
          </div>
          <div class="col-md-12 p-top" >
            <label class="col-md-2"> Estado: </label>
            <div class="col-md-8" >
              @if($s_attention->status == 0)
                <input type="radio" name="status" value = "0" checked> En espera de confirmacion de paciente
              @else
                <input type="radio" name="status" value = "0"> En espera de confirmacion de paciente 
              @endif
              <br>
              @if($s_attention->status == 1)
                <input type="radio" name="status" value = "1" checked> Confirmado por paciente
              @else
                <input type="radio" name="status" value = "1"> Confirmado por paciente
              @endif
              <br>
              @if($s_attention->status == 2)
                <input type="radio" name="status" value = "2" checked> Atendido
              @else
                <input type="radio" name="status" value = "2"> Atendido
              @endif
              <br>
              @if($s_attention->status == 3)
                <input type="radio" name="status" value = "3" checked> Cancelado
              @else
                <input type="radio" name="status" value = "3"> Cancelado
              @endif
            <br>
            </div>
          </div>
      </div>
      <input id="id" type="hidden" name="app_id" value = 
                         {{$s_attention->id}}> 
      <input id="id" type="hidden" name="attention_id" value = 
                         {{$attention->id}}> 

      <div class="col-md-4 ">
          <img src="/images/medic_date.png" style="width:100%;">  
      </div>  
        <div class="col-md-12 ">
          <div class="col-md-4 "></div>
          <div class="col-md-4 ">
            <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>    Guardar cambios  </button>   
          </div>
          </form>
          </div>
          <div class="col-md-12 ">
          <div class="col-md-4 "></div>
          <div class="col-md-4 ">
          <a href="/appointments/detail/{{$attention->id}}"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
          </div>
          </div>
        </div>      
      </div>
        <!-- /.box-body -->
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
      showMeridian:false,
      defaultTime:false
    })

    $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    })

    }); 
</script>
@endsection