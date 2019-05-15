@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar una Solicitud de Servicio DocDoor</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/d_services/edit">
                         {{ csrf_field() }}


                        <div class="form-group">
                            <label for="partner_id" class="col-md-4 control-label">Asociado *</label>

                            <div class="col-md-6">
                                <select class="form-control" name = "partner_id" >
                                <option value=""> {{$partner_name}} (actual) </option>
                                @foreach($partners as $partner)
                              <option value="<?=$partner->id?>"><?=$partner->partner_name?></option>
                            @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_to" class="col-md-4 control-label">Delivery *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" placeholder="{{$d_service->delivery}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_to" class="col-md-4 control-label">Ejecución *</label>

                            <div class="col-md-6">
                                <input id="address_to" type="text" class="form-control" name="address_to" placeholder="{{$d_service->execution}}">
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>

                        <input id="id" type="hidden" name="id" value = 
                         {{$d_service->id}}> 


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