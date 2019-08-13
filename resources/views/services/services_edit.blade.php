@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar un Servicio </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/services/edit">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label" >Nombre *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="service_name" placeholder ="{{$esp->service_name}}" >
                                <b>* Campo Obligatorio</b>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$esp->id}}">


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" >
                                    <i class="fa fa-btn fa-user"></i> Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 col-md-offset-1">
                      <a href="/services">
                        <button type="submit" class="btn btn-primary bg-olive" >
                           Volver al menú
                        </button>  
                      </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
