@extends('layouts.template')

@section('content')
<style type="text/css">
  .p-left{
    padding-left: 5%;
  }
  #map {
        height: 400px;
      }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body p-left">
      @if($attention ->type == 1)
        <h3> Información de la Cita médica</h3>
      @else
        @if($s_attention ->emergency_type == 0)
        <h3> Información de la Emergencia</h3>
       @else
        <h3> Información de la Urgencia</h3>
       @endif
      @endif
      <br>
      <div class="col-md-6">
        <div class="col-md-12" >
          <span class="col-md-4"> Código de la atención: </span>
          <label  class="col-md-8">{{$attention -> attention_code}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Paciente: </span>
          <label  class="col-md-8">{{$user_patient->name}} </label>
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
          @if($attention->reference)
            <label  class="col-md-8">{{$attention->reference}} </label>
          @else
            <label  class="col-md-8"> - </label>
          @endif
          
        </div>
        @if($attention ->type == 1)
        

        <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Detalles de la cita médica</label>
            </h4>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Especialidad: </span>
            <label  class="col-md-8">{{$specialty->name}} </label>
          </div>
          <div class="col-md-12" >
            <span class="col-md-4"> Doctor: </span>
            <label  class="col-md-8">{{$user_doctor->name}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Fecha de la cita: </span>
            <label  class="col-md-8">{{$s_attention->date_time}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Estado: </span>
            @if($s_attention->status == 0)
            <label  class="col-md-8"> Aun no atendida </label>
            @else 
              @if($s_attention->status == 1)
              <label  class="col-md-8"> Confirmada </label>
              @else
                @if($s_attention->status == 2)
                <label  class="col-md-8"> Atendida </label>
                @else 
                  @if($s_attention->status == 3)
                  <label  class="col-md-8"> Cancelada </label>
                  @endif
                @endif
              @endif
            @endif
          </div>
          @if($s_attention->status == 2)
          <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Historia Clínica</label>
            </h4>
          </div>
          <div class="col-md-12" >
            <span class="col-md-4"> Frecuencia cardiaca: </span>
            <label  class="col-md-8">{{$history->cardiac_frequency }} </label>
          </div>
          <div class="col-md-12" >
            <span class="col-md-4"> Frecuencia respiratoria: </span>
            <label  class="col-md-8">{{$history->breathing_frequency }} </label>
          </div>
          <div class="col-md-12" >
            <span class="col-md-4"> Temperatura: </span>
            <label  class="col-md-8">{{$history->temperature }} </label>
          </div>
          <div class="col-md-12" >
            <span class="col-md-4"> Presión Arterial: </span>
            <label  class="col-md-8">{{$history->arterial_pressure }} </label>
          </div>
          <div class="col-md-12" >
            <span class="col-md-4"> Antecedentes Personales: </span>
            <label  class="col-md-8">{{$history->personal_antecedents }} </label>
          </div>
          <div class="col-md-12" >
            <span class="col-md-4"> Antecedentes Familiares: </span>
            <label  class="col-md-8">{{$history->family_antecedents }} </label>
          </div>
          <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Receta médica</label>
            </h4>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Medicinas recetadas: </span>
            <label  class="col-md-8">
              <ul>
                <?php foreach ($medicines as $med): ?>
                <li> {{$med['quantity']}} {{$med['name']}} </li>
                 <?php endforeach ?> 
              </ul>
            </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Instrucciones: </span>
            <label  class="col-md-8">{{$recipe->instructions }} </label>
          </div>

          @endif
          
        @else
          <div class="col-md-12" >
            <span class="col-md-4"> Servicio de respuesta: </span>
            @if($s_attention->response_type == 0)
            <label  class="col-md-8"> Sin servicio de respuesta </label>
            @else
              @if($s_attention->response_type == 1)
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
            <label  class="col-md-8">{{$s_attention->caller_name}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> DNI: </span>
            <label  class="col-md-8">{{$s_attention->caller_dni}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Celular: </span>
            <label  class="col-md-8">{{$s_attention->caller_cell}} </label>
          </div>

          <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Contacto adicional </label>
            </h4>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Nombre: </span>
            <label  class="col-md-8">{{$s_attention->oc_name}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Celular: </span>
            <label  class="col-md-8">{{$s_attention->oc_cell}} </label>
          </div>

          <div class="col-md-12" >
            <span class="col-md-4"> Relación con el paciente: </span>
            <label  class="col-md-8">{{$s_attention->oc_relationship}} </label>
          </div>
        @endif
      </div>

      <div class="col-md-6 ">
        @if($attention ->type == 1)
          <!--<img src="/images/medic_date.png" style="width:100%;"> -->
          <div class="col-md-12 ">  
            <div id="map" class="m-left"></div>
           </div> 
        @else
          <img src="/images/ambulance.png" style="width:100%;">
        @endif
            
      </div>  
        <div class="col-md-12 ">
          <div class="col-md-4 "></div>
          <div class="col-md-8 ">
          @if($attention ->type == 1)
            @if($s_attention->status < 2)
            <a href="/appointments/edit/{{$attention->id}}"> 
             <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Cita Médica</button>
            </a>
            @endif  
          @endif  
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
     function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: -16.405363, lng: -71.533260}
        });
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(-16.4052938, -71.5425724),
          map: map,
          title: "Dirección de la cita",          
        });
      }

    </script>
    <script async defer
    src="https://maps.google.com/maps/api/js?key=AIzaSyCILxmzsVKpgprW3wmiVyBk3-ylNy2g8Vc&callback=initMap">
    </script>
@endsection