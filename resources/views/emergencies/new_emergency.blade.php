@extends('layouts.template')

@section('content')
<style type="text/css">
    #map {
        margin-left: 10%;
        height: 400px;
      }
    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 16px;
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
                <div class="panel-heading">Registrar una Emergencia de un usuario registrado</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/emergency">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="patient_id" class="col-md-4 control-label">Nombre del paciente *</label>

                            <div class="col-md-6">
                                <select class="form-control" name = "patient_id" >
                                    <option value=""> Seleccione un paciente </option>
                                    @foreach($users as $patient)
                                    <option value="<?=$patient['id']?>"><?=$patient['name']?></option>
                                    @endforeach
                            </select>
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
                                <input id="address2" type="text" class="form-control" name="address" readonly="readonly">   
                                 <b>Nota: Los campos con * son obligatorios</b>
                                <input id = "att_latitude" type="hidden" name="att_latitude">
                                <input id = "att_longitude" type="hidden" name="att_longitude">    
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-md-offset-2 ">  
                            <input id="pac-input" class="controls" type="text" placeholder="Ingrese una Dirección">

                            <div id="map" class="m-left"></div>
                        </div>

                        <div class="form-group">
                            <label for="reference" class="col-md-4 control-label">Referencia </label>

                            <div class="col-md-6">
                                <input id="reference" type="text" class="form-control" name="reference" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="motive" class="col-md-4 control-label">Tipo de emergencia  *</label>

                            <div class="col-md-6">
                                <input type="radio" name="emergency_type" value = "0" checked> Emergencia
                                <input type="radio" name="emergency_type" value = "1" > Urgencia
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="motive" class="col-md-4 control-label">Tipo de servicio de respuesta  *</label>

                            <div class="col-md-6">
                                <input type="radio" name="response_type" value = "0" checked> Sin servicio
                                <input type="radio" name="response_type" value = "1" > Bomberos
                                <input type="radio" name="response_type" value = "2" > Cruz Roja
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-md-8 control-label">Información de la persona que está llamando (opcional) </label>
                        </div>

                        <div class="form-group">
                            <label for="caller_name" class="col-md-4 control-label">Nombre  </label>

                            <div class="col-md-6">
                                <input id="caller_name" type="text" class="form-control" name="caller_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="caller_last_name" class="col-md-4 control-label">Apellido  </label>

                            <div class="col-md-6">
                                <input id="caller_last_name" type="text" class="form-control" name="caller_last_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="caller_dni" class="col-md-4 control-label">DNI </label>

                            <div class="col-md-6">
                                <input id="caller_dni" type="text" class="form-control" name="caller_dni" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="caller_cell" class="col-md-4 control-label">Celular  </label>

                            <div class="col-md-6">
                                <input id="caller_cell" type="text" class="form-control" name="caller_cell" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Información de un contacto adicional (opcional) </label>
                        </div>

                        <div class="form-group">
                            <label for="oc_name" class="col-md-4 control-label">Nombre del contacto</label>

                            <div class="col-md-6">
                                <input id="oc_name" type="text" class="form-control" name="oc_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="oc_cell" class="col-md-4 control-label">Celular del contacto</label>

                            <div class="col-md-6">
                                <input id="oc_cell" type="text" class="form-control" name="oc_cell" >

                            </div>
                        </div>
                         <div class="form-group">
                            <label for="oc_relationship" class="col-md-4 control-label">Relación con el paciente</label>

                            <div class="col-md-6">
                                <input id="oc_relationship" type="text" class="form-control" name="oc_relationship" >

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
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
<script>
  $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
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

        });

        document.getElementById('pac-input').addEventListener('keypress', function(e) {
             var key = e.keyCode || e.which;
             if(key == 13){
                e.preventDefault();
                return false;
             }          
        }); 

      }

    </script>
    <script async defer
    src="https://maps.google.com/maps/api/js?key=AIzaSyA6Nem6HRVGgsqitMo1HKjNfdeMPl-eQa0&amp;libraries=places&amp;callback=initAutocomplete">

@endsection