@extends('layouts.template')

@section('content')
<style type="text/css">
  .imgAvatar {
    width:200px;
    height:200px;
    border-radius:150px;
  }
  .p-left{
    padding-left: 5%;
  }
</style>
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
      <h3> Información de la Solicitud de Servicio DocDoor<br></h3>
      <div class="col-md-6">
        <div class="col-md-12" >
          <span class="col-md-4"> Paciente: </span>
          <label  class="col-md-8">{{$user->name}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Servicio: </span>
          <label  class="col-md-8">{{$service->service_name}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Asociado: </span>
          <label  class="col-md-8">{{$partner->partner_name}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Costo: </span>
          <label  class="col-md-8">s/. {{$data->cost}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Dirección de salida: </span>
          <label  class="col-md-8">{{$data->address_from}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Dirección de llegada:: </span>
          <label  class="col-md-8">{{$data->address_to}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Fecha de solicitud: </span>
          <label  class="col-md-8">{{$data->created_at }} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Fecha de ejecución: </span>
          @if($data->execution)
            <label  class="col-md-8">{{$data->execution}} </label>
          @else
            <label  class="col-md-8"> Aun no se realizó </label>
          @endif
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Fecha de entrega de resultados: </span>
          @if($data->delivery)
            <label  class="col-md-8">{{$data->delivery}} </label>
          @else
            <label  class="col-md-8"> Aun no se entregó resultados </label>
          @endif
        </div>
        <div class="col-md-12" >
          <span class="col-md-4"> Estado: </span>
          @if($data->complete)
           <label  class="col-md-8">Completado </label>
          @else
            <label  class="col-md-8">Incompleto </label>
          @endif
        </div>
       </div>
      <div class="col-md-6">
        <div class="col-md-12 ">  
          <div id="map" class="m-left"></div>
        </div> 
        <div class="col-md-12 ">
          <div class="col-md-2 "></div>
          <div class="col-md-6 ">
            <!--<button type="button" id = "buttonUpdateLocation" class="btn bg-success margin" style="margin-left: 30%;">  <i class="fa fa-save"></i>  Guardar Nueva Dirección</button> -->
             <div id="responseUpdate" style="margin-left: 10%;" ></div>
          </div>
        </div>            
      </div>  
      
        <div class="col-md-12 ">
          <div class="col-md-4 "></div>
          <div class="col-md-8 ">
          @if(Auth::user()->role == 2)
            <a href="/d_services/edit/{{$data->id}}">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Solicitud</button></a>
          @endif  
          @if(Auth::user()->role == 3)
            <a href="/patients/my_d_services">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-list"></i>  Volver a mis solicitudes</button></a>
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
  $( "#buttonUpdateLocation" ).click(function() {

    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng()
    var parametros={
            "ds_id":{{$data->id}},
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
                $("#responseUpdate").append("<i class=\"fa fa-times\"></i> ");
                $("#responseUpdate").append(response);
            }
          }
    }); 
  }); 

     function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: <?php echo $data->address_to_latitude?>    ,lng:<?php echo $data->address_to_longitude?> }
        });
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(<?php echo $data->address_to_latitude?>, <?php echo $data->address_to_longitude?>),
          map: map,
          title: "Dirección de llegada de la solicitud", 
          draggable : false,          
        });
      }

    </script>
    <script async defer
    src="https://maps.google.com/maps/api/js?key=AIzaSyCILxmzsVKpgprW3wmiVyBk3-ylNy2g8Vc&callback=initMap">
    </script>
@endsection