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
       @if($u_emergency ->emergency_type == 0)
        <h3> Información de la Emergencia</h3>
       @else
        <h3> Información de la Urgencia</h3>
       @endif
      <br>
      <div class="col-md-8">
        <div class="col-md-12" >
          <span class="col-md-4"> Código de la atención: </span>
          <label  class="col-md-8">UEM-{{$u_emergency -> id}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Paciente: </span>
          <label  class="col-md-8">{{$u_emergency->p_name}} {{$u_emergency->p_last_name}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Motivo: </span>
          <label  class="col-md-8">{{$u_emergency->motive}} </label>
        </div>

        <div class="col-md-12" >
          <span class="col-md-4"> Dirección: </span>
          <label  class="col-md-8">{{$u_emergency->address}} </label>
        </div>

        <div class="col-md-12" >
          <span class="col-md-4"> Referencia: </span>
          @if($u_emergency->reference)
            <label  class="col-md-8">{{$u_emergency->reference}} </label>
          @else
            <label  class="col-md-8"> - </label>
          @endif
          
        </div>

        <div class="col-md-12" >
            <span class="col-md-4"> Servicio de respuesta: </span>
            @if($u_emergency->response_type == 0)
            <label  class="col-md-8"> Sin servicio de respuesta </label>
            @else
              @if($u_emergency->response_type == 1)
               <label  class="col-md-8"> Bomberos </label>
              @else
               <label  class="col-md-8"> Cruz Roja </label>
              @endif
            @endif
        </div>

        <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Información de la persona que llamó </label>
            </h4>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Nombre: </span>
            <label  class="col-md-8">{{$u_emergency->caller_name}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> DNI: </span>
            <label  class="col-md-8">{{$u_emergency->caller_dni}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Celular: </span>
            <label  class="col-md-8">{{$u_emergency->caller_cell}} </label>
          </div>

          <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Contacto adicional </label>
            </h4>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Nombre: </span>
            <label  class="col-md-8">{{$u_emergency->oc_name}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Celular: </span>
            <label  class="col-md-8">{{$u_emergency->oc_cell}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Relación con el paciente: </span>
            <label  class="col-md-8">{{$u_emergency->oc_relationship}} </label>
          </div>
      </div>

      <div class="col-md-4 ">
          <img src="/images/ambulance.png" style="width:100%;">
            
      </div>        
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection