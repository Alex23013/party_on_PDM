@extends('layouts.template')

@section('content')
<style type="text/css">
  .p-left{
    padding-left: 5%;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body p-left">
      @if($attention ->type == 2)
        <h3> Información de la Emergencia</h3>
      @else
        <h3> Información de la Cita médica</h3>
      @endif
      <br>
      <div class="col-md-8">
        <div class="col-md-12" >
          <span class="col-md-4"> Código: </span>
          <label  class="col-md-8">{{$attention -> attention_code}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Paciente: </span>
          <label  class="col-md-8">{{$user->name}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Motivo: </span>
          <label  class="col-md-8">{{$attention->motive}} </label>
        </div>

        <div class="col-md-12" >
          <span class="col-md-4"> Dirección: </span>
          <label  class="col-md-8">{{$attention->address}} </label>
        </div>

        <div class="col-md-12" >
          <span class="col-md-4"> Referencia: </span>
          <label  class="col-md-8">{{$attention->reference}} </label>
        </div>

        
        @if($attention ->type == 2)
          <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Información de la persona que llamó </label>
            </h4>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Nombre: </span>
            <label  class="col-md-8">{{$emergency->caller_name}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> DNI: </span>
            <label  class="col-md-8">{{$emergency->caller_dni}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Celular: </span>
            <label  class="col-md-8">{{$emergency->caller_cell}} </label>
          </div>

          <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Contacto adicional </label>
            </h4>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Nombre: </span>
            <label  class="col-md-8">{{$emergency->oc_name}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> DNI: </span>
            <label  class="col-md-8">{{$emergency->oc_dni}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Celular: </span>
            <label  class="col-md-8">{{$emergency->oc_cell}} </label>
          </div>
        @else
           
        @endif
      </div>

      <div class="col-md-4 ">
        @if($attention ->type == 2)
          <img src="/images/ambulance.png" style="width:100%;">
        @else
          <img src="/images/medic_date.png" style="width:100%;">  
        @endif
            
      </div>  
        <div class="col-md-12 ">
          <div class="col-md-4 "></div>
          <div class="col-md-8 ">
          @if($attention ->type == 2)
            <a href="/emergency/edit/{{$attention->id}}"> 
             <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Emergencia</button>
            </a>
          @else
            <a href="/appointment/edit/{{$attention->id}}"> 
             <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Cita Médica</button>
            </a>
          @endif  
          </div>
        </div>      
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection