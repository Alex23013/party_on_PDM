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
        <h3> Información de la Cita médica</h3>
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
          
      </div>

      <div class="col-md-6 ">
        <div class="col-md-12 ">  
          <div id="map" class="m-left"></div>
        </div>             
      </div>  
        <div class="col-md-12 ">
          <div class="col-md-6 "></div>
          <div class="col-md-6 ">
             <button type="button" id = "buttonUpdateLocation" class="btn bg-success margin" style="margin-left: 30%;">  <i class="fa fa-save"></i>  Guardar Nueva Dirección</button>
             <div id="responseUpdate" style="margin-left: 10%;" > </div>
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
  $( "#buttonUpdateLocation" ).click(function() {

    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng()
    var parametros={
      "_token":"{{ csrf_token() }}",
      "attention_id":{{$attention->id}},
      "att_latitude":lat,
      "att_longitude": lng,
    };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: '/patients/update_location_appointment',
        type: 'post',
        beforeSend: function(){
          $("#resUpdate").html("Procesando,espere..");
        },
        success: function(response){
          console.log("events_response",response);
          $("#resUpdate").empty();
          if(response == 1){
            $("#responseUpdate").append("<i class=\"fa fa-check\"></i> Ubicación de la cita actualizada con éxito")
            }else{
              $("#responseUpdate").append("<i class=\"fa fa-times\"></i> ")
              $("#responseUpdate").append(response)
            }
        }
      }); 
   });
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: {lat: <?php echo $attention->att_latitude?>    ,lng:<?php echo $attention->att_longitude?> }
    });
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?php echo $attention->att_latitude?>, <?php echo $attention->att_longitude?>),
      map: map,
      title: "Dirección de la cita",
      draggable : true,          
    });
  }

  </script>
  <script async defer
    src="https://maps.google.com/maps/api/js?key=AIzaSyCILxmzsVKpgprW3wmiVyBk3-ylNy2g8Vc&callback=initMap">
  </script>
@endsection