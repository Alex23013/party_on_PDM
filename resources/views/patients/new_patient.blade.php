@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar un Paciente</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/patients">
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

                        <input id="id" type="hidden" name="password" value ="123456">

                        <div class="form-group">
                            <label for="dni" class="col-md-4 control-label">DNI *</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" >
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="cellphone" class="col-md-4 control-label">Email *</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" >
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="cellphone" class="col-md-4 control-label">Celular *</label>

                            <div class="col-md-6">
                                <input id="cellphone" type="text" class="form-control" name="cellphone" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Fecha de Nacimiento * </label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="birth_at" >
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Información de contacto de Emergencia (opcional) </label>
                        </div>

                        <div class="form-group">
                            <label for="ec_name" class="col-md-4 control-label">Nombre del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_name" type="text" class="form-control" name="ec_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ec_last_name" class="col-md-4 control-label">Apellido del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_last_name" type="text" class="form-control" name="ec_last_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ec_cellphone" class="col-md-4 control-label">Celular del contacto</label>

                            <div class="col-md-6">
                                <input id="ec_cellphone" type="text" class="form-control" name="ec_cellphone" >

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            @if ($type)
                            <button type="submit" class="btn btn-primary" name = "Registrar" value="1">
                            @else
                            <button type="submit" class="btn btn-primary" name = "Registrar" value="0">
                            @endif
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

@section('specific scripts')
<script>
  $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    })
</script>

@endsection
