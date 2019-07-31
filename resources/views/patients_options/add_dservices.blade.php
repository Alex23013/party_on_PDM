@extends('layouts.template')

@section('content')
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
                            <label for="address_to" class="col-md-4 control-label">Dirección *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" >
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
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
