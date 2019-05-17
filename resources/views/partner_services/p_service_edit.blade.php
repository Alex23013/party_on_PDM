@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar costos de {{$p_service->service_name}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/p_services/{{$id_P}}/edit">
                         {{ csrf_field() }}

                        <div class="form-group">
                            <label for="service_cost" class="col-md-4 control-label">Costo del servicio </label>

                            <div class="col-md-6">
                                <input id="service_cost" type="text" class="form-control" name="service_cost" placeholder="{{$p_service->service_cost}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="docdoor_cost" class="col-md-4 control-label">Costo DocDoor </label>

                            <div class="col-md-6">
                                <input id="docdoor_cost" type="text" class="form-control" name="docdoor_cost" placeholder="{{$p_service->docdoor_cost}}" >
                            </div>
                        </div>
                        
                        <input id="id" type="hidden" name="id" value = 
                         {{$p_service->id}}>       

                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>    Guardar cambios  </button> 
                            </div>
                     
                    </form>
                    <div class="col-md-6 col-md-offset-4">
                        <br>
                          <a href="/p_services/{{$id_P}}"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button>
                          </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection