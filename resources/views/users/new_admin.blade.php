@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar un Administrador</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/users">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-md-4 control-label">Apellido *</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dni" class="col-md-4 control-label">DNI</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail *</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Contraseña *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cellphone" class="col-md-4 control-label">Celular *</label>

                            <div class="col-md-6">
                                <input id="cellphone" type="text" class="form-control" name="cellphone" >
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>

                        <input id="input-role" type="hidden" name="role" value = 0>
                        <input id="input-name_role" type="hidden" name="name_role" value = Administrador>

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