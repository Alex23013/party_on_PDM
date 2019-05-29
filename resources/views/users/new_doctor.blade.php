@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar un Doctor</div>
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

                            <label for="name" class="col-md-4 control-label">
                            Nombre *</label>

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
                            <label for="dni" class="col-md-4 control-label">DNI*</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail * </label>

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
                        <input id="input-role" type="hidden" name="role" value = 1>
                        <input id="input-name_role" type="hidden" name="name_role" value = "Doctor">

                        <div class="form-group">
                            <label class="col-md-8 control-label">Información Adicional </label>
                        </div>

                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Fecha de Nacimiento * </label>

                            <div class="col-md-6">
                                <input id="datepicker" type="text" class="form-control" name="birth_at" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="college" class="col-md-4 control-label">Colegiaturas </label>

                            <div class="col-md-6">
                                <input id="college" type="text" class="form-control" name="college" >
                                separadas por '/ ' si tiene más de una
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Dirección *</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="specialty" class="col-md-4 control-label">Especialidad </label>

                            <div class="col-md-6">
                                <select class="form-control" name = "specialty" >
                                    @foreach($specialties as $s)
                                      <option value="<?=$s->name?>"><?=$s->name?></option>
                                    @endforeach
                                </select>
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


@section('specific scripts')
<script>
  $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    })
</script>

@endsection
