@extends('layouts.template')
 
@section('content')
<style type="text/css">
    #map {
        height: 400px;
      }
    .m-left{
        margin-left: 20%;
    }    
    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

    #pac-input:focus {
      border-color: #4d90fe;
    }
</style>
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
                            <label for="address" class="col-md-4 control-label">Dirección *</label>

                            <div class="col-md-6">
                                <input id="address2" type="text" class="form-control" name="address" readonly="readonly">   
                                <input id = "att_latitude" type="hidden" name="att_latitude">
                                <input id = "att_longitude" type="hidden" name="att_longitude">    
                            </div>
                        </div>
                       
                        <div class="form-group col-md-10 col-md-offset-2 ">  
                            <input id="pac-input" class="controls" type="text" placeholder="Ingrese una Dirección">

                            <div id="map" class="m-left"></div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="reference" class="col-md-4 control-label">Referencia </label>

                            <div class="col-md-6">
                                <input id="reference" type="text" class="form-control" name="reference" >
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="motive" class="col-md-4 control-label">Motivo de Consulta *</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name = "motive" rows="3" placeholder="Describa el problema"></textarea>
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
                            <div class="col-md-6" >
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
      format: 'yyyy-mm-dd',
    })

    }); 
</script>
<script>
    
    var submit_button = document.getElementById("submit_button");

    var input_date = document.getElementById("datepicker");
    input_date.disabled=true;

    var input_time = document.getElementById("input_time");
    input_time.disabled=true;
    var locations = [];
    

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
                locations = [];
                console.log("response: ",response);
                $("#resultado").html(response); 
                 var doctorSelect= document.getElementById('doctor_select');
                $(doctorSelect).empty();
                $(doctorSelect).append('<option value=""> Seleccione un doctor</option>')
                for (var i = 0; i < response.length; i++) {
                    $(doctorSelect).append('<option data-horario=\''+response[i].schedule+'\' value="' + response[i].id + '">' + response[i].name + '</option>');
                    locations.push([response[i].name,response[i].latitude,response[i].longitude]);
                }         
                console.log("loc.sze(): ",locations.length);         
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
        if(specialty_id < 3){
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
            $("#location").append("<div style =\" margin-left:10%\">" +
                "<div class=\"col-md-2\" style=\"background-color: #336600; color :#336600; border-radius: 10px;\"> S </div><div class=\"col-md-10\">Horario de atención</div>"+
                "<div class=\"col-md-2\" style=\"background-color: #cc0000; color :#cc0000; border-radius: 10px;margin-top: 10px\"> S </div><div class=\"col-md-10\"style = \"margin-top: 10px\">Confirmadas</div>"+
                "<div class=\"col-md-2\" style=\"background-color: #476b6b; color :#476b6b; border-radius: 10px;margin-top: 10px\"> S </div><div class=\"col-md-10\" style = \"margin-top: 10px; margin-bottom:10px\">Reservadas</div>"+
                "</div>"+
                "<div id=\"calendar1\" class=\"padding-border-table\" style=\"margin-top:10px\">"+"</div>")
            var parametros={
                "val1":$('#doctor_select').find(':selected').val(),
            };
            console.log("paramEvents: user_id->",parametros);
            $.ajax({
                data: parametros,
                url: '/ajax_get_schedule_by_user_id',
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
<script>
     function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -16.4052938, lng: -71.5425724},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            var latitude = place.geometry.location.lat();
            var longitude = place.geometry.location.lng();
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
            document.getElementById("address2").value = document.getElementById('pac-input').value;
            document.getElementById("att_latitude").value =latitude;
            document.getElementById("att_longitude").value =longitude;
          });
          map.fitBounds(bounds);

          var infowindow = new google.maps.InfoWindow();
          var marker, i;
            console.log("locations-doctors", locations.length); 
            for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
              });
              markers.push(marker);
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
        });

        document.getElementById('pac-input').addEventListener('keypress', function(e) {
             var key = e.keyCode || e.which;
             if(key == 13){
                e.preventDefault();
                return false;
             }          
        }); 

      }
   /*
     function initMap() {   
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: -16.405363, lng: -71.533260}
        });

        var geocoder = new google.maps.Geocoder();

        document.getElementById('address2').addEventListener('keypress', function(e) {
             var key = e.keyCode || e.which;
             if(key == 13){
                geocodeAddress(geocoder, map);
                e.preventDefault();
                return false;
             }          
        }); 
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address2').value;
        geocoder.geocode({'address': address}, function(results, status) {
            console.log("resul",results," ",status);
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker1 = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location,
              icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
              //title: 'Hello World!'
            }); 
            google.maps.event.addListener(marker1, 'click', (function(marker1) {
                return function() {
                  infowindow.setContent('Dirección solicitada');
                  infowindow.open(map, marker1);
                }
            })(marker1));
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            
            for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: resultsMap,
                
              });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
            })(marker, i));
            }

          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }*/
    </script>
    <script async defer
    src="https://maps.google.com/maps/api/js?key=AIzaSyA6Nem6HRVGgsqitMo1HKjNfdeMPl-eQa0&amp;libraries=places&amp;callback=initAutocomplete"></script>

@endsection