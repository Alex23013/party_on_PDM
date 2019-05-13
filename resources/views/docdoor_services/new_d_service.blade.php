@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar una Solicitud de Servicio DocDoor</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/d_services">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="dni" class="col-md-4 control-label"> DNI del paciente *</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" >
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="service_id" class="col-md-4 control-label">Servicio *</label>

                            <div class="col-md-6">
                                <select class="form-control" name = "service_id" >
                                <option value=""> Seleccione un servicio </option>
                                @foreach($services as $service)
                              <option value="<?=$service->id?>"><?=$service->service_name?></option>
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="partner_id" class="col-md-4 control-label">Asociado *</label>

                            <div class="col-md-6">
                                <select class="form-control" name = "partner_id" >
                                <option value=""> Seleccione un asociado </option>
                                @foreach($partners as $partner)
                              <option value="<?=$partner->id?>"><?=$partner->partner_name?></option>
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_from" class="col-md-4 control-label">Dirección de salida*</label>

                            <div class="col-md-6">
                                <input id="address_from" type="text" class="form-control" name="address_from" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_to" class="col-md-4 control-label">Direccion de llegada *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" >
                                <b>Nota: Los campos con * son obligatorios</b>
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