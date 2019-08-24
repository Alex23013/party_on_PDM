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
                <div class="panel-heading">Hacer una solicitud de <b>{{$service->service_name}}</b> con el proveedor <b>{{$partner->partner_name}}</b></div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/patients/add_dservices">
                         {{ csrf_field() }}
 
                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Dirección de llegada *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" readonly="readonly">   
                                <input id = "att_latitude" type="hidden" name="address_to_latitude">
                                <input id = "att_longitude" type="hidden" name="address_to_longitude"> 
                                <b>Nota: Los campos con * son obligatorios</b>   
                            </div>
                        </div>
                        <div class="form-group col-md-10 col-md-offset-2 ">  
                            <input id="pac-input" class="controls" type="text" placeholder="Ingrese una Dirección de llegada">

                            <div id="map" class="m-left"></div>
                        </div>

                        <input type="hidden" name="service_id" value = "{{$service->id}}" >

                        <input type="hidden" name="partner_id" value = "{{$partner->id}}" >
                        <input type="hidden" name="cost" value = "{{$cost}}" >

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-suitcase"></i> Solicitar
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
<script type="text/javascript">
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
            document.getElementById("address_to").value = document.getElementById('pac-input').value;
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
</script>
    <script async defer
    src="https://maps.google.com/maps/api/js?key=AIzaSyA6Nem6HRVGgsqitMo1HKjNfdeMPl-eQa0&amp;libraries=places&amp;callback=initAutocomplete">

@endsection