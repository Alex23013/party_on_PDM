@extends('layouts.template')

@section('content')
<style type="text/css">
  
  .p-left{
    padding-left: 5%;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body p-left">
      <h3> Historia Clinica de la cita {{$info['attention_code']}}</h3><br>
      <div class="col-md-12">
        <div class="col-md-12" >
          <span class="col-md-3"> Doctor: </span>
          <label  class="col-md-6"> {{$info['doctor_name']}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Fecha: </span>
          <label  class="col-md-6"> {{$info['date']}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Hora: </span>
          <label  class="col-md-6"> {{$info['time']}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Motivo de la Consulta: </span>
          <label  class="col-md-6"> {{$info['motive']}}</label>
        </div>

        <div class="col-md-12" >
          <label> Informacion del Paciente </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Nombre: </span>
          <label  class="col-md-6"> {{$info['patient-name']}}</label>
        </div>

        <div class="col-md-12">
          <span class="col-md-3"> Apellido: </span>
          <label  class="col-md-6"> {{$info['patient-last_name']}}</label>
        </div>
        <div class="col-md-12" >
          <label> Detalle </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Frecuencia Cardiaca: </span>
          <label  class="col-md-6"> {{$info['cardiac_frequency']}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Frecuencia Respiratoria: </span>
          <label class="col-md-6">{{$info['breathing_frequency']}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Temperatura: </span>
          <label  class="col-md-6"> {{$info['temperature']}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Presion Arterial: </span>
          <label  class="col-md-6"> {{$info['arterial_pressure']}}</label>
        </div>
        <div class="col-md-12" >
          <label> Antecedentes </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Personales: </span>
          <label  class="col-md-6"> {{$info['personal_antecedents']}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-3"> Familiares: </span>
          <label  class="col-md-6"> {{$info['family_antecedents']}}</label>
        </div>
      </div> 
      
        
        <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          @if($info['pdf_status'] == 0 )
          <a href="#"> <button class="btn  btn-flat bg-purple m-left">  <i class="fa fa-edit"></i> Solicitar permiso para exportar PDF </button> 
          </a>
          @endif
          @if($info['pdf_status'] == 1 )
          <button class="btn  btn-flat bg-purple m-left"> En espera del permiso para exportar PDF</button> 
          @endif
          @if($info['pdf_status'] == 2 )
          <a href="#"> <button class="btn  btn-flat bg-olive m-left">  <i class="fa fa-list"></i> Exportar PDF </button> 
          </a>
          @endif
        </div>
        <div class="col-md-3"></div>
      </div>   
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection