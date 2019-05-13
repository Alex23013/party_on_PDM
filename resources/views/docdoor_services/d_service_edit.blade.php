@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar una Solicitud de Servicio DocDoor</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/d_services">
                         {{ csrf_field() }}


                        <div class="form-group">
                            <label for="address_from" class="col-md-4 control-label">Dirección de salida*</label>

                            <div class="col-md-6">
                                <input id="address_from" type="text" class="form-control" name="address_from" placeholder="{{$d_service->address_from}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_to" class="col-md-4 control-label">Direccion de llegada *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" placeholder="{{$d_service->address_to}}">
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_to" class="col-md-4 control-label">Delivery *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" placeholder="{{$d_service->address_to}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_to" class="col-md-4 control-label">Ejecución *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" placeholder="{{$d_service->address_to}}">
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>    Guardar cambios  </button> 
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 col-md-offset-4">
                        <br>
                          <a href="/d_services"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection