@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar un Asociado</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/partners">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sector" class="col-md-4 control-label">Rubro *</label>

                            <div class="col-md-6">
                                <input id="sector" type="text" class="form-control" name="sector" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="social_reason" class="col-md-4 control-label">Razón Social *</label>

                            <div class="col-md-6">
                                <input id="social_reason" type="text" class="form-control" name="social_reason" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ruc" class="col-md-4 control-label">RUC *</label>

                            <div class="col-md-6">
                                <input id="ruc" type="text" class="form-control" name="ruc" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Dirección *</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cell_1" class="col-md-4 control-label">Celular 1 *</label>

                            <div class="col-md-6">
                                <input id="cell_1" type="text" class="form-control" name="cell_1" >
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cell_2" class="col-md-4 control-label">Celular 2</label>

                            <div class="col-md-6">
                                <input id="cell_2" type="text" class="form-control" name="cell_2" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="hours_of_operation" class="col-md-4 control-label">Horario de atención</label>

                            <div class="col-md-6">
                                <input id="hours_of_operation" type="text" class="form-control" name="hours_of_operation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="current_acount" class="col-md-4 control-label">Número de Cuenta Corriente</label>

                            <div class="col-md-6">
                                <input id="current_acount" type="text" class="form-control" name="current_acount" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="web_page" class="col-md-4 control-label">Página web</label>

                            <div class="col-md-6">
                                <input id="web_page" type="text" class="form-control" name="web_page" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" >
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