@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Agregar un Servicio</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/p_services/{{$id_P}}">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="service_cost" class="col-md-4 control-label">Costo del servicio </label>

                            <div class="col-md-6">
                                <input id="service_cost" type="text" class="form-control" name="service_cost" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="docdoor_cost" class="col-md-4 control-label">Costo DocDoor </label>

                            <div class="col-md-6">
                                <input id="docdoor_cost" type="text" class="form-control" name="docdoor_cost" >
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