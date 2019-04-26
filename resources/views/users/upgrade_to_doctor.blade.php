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
                            <label class="col-md-8 control-label">Información Adicional  para cambiar de rol a Doctor</label>
                        </div>

                        <div class="form-group">
                            <label for="birth" class="col-md-4 control-label">Fecha de Nacimiento * </label>

                            <div class="col-md-6">
                                <input id="birth_at" type="date" class="form-control" name="birth_at" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="college" class="col-md-4 control-label">Colegiaturas </label>

                            <div class="col-md-6">
                                <input id="college" type="text" class="form-control" name="college" placeholder="{{$user->college}}">
                                separadas por '/ ' si tiene más de una
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Dirección *</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" >
                                <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="specialty" class="col-md-4 control-label">Especialidad </label>

                            <div class="col-md-6">
                                <select class="form-control" name = "specialty" >
                                    <option value=""> médico general</option>
                                    @foreach($specialties as $s)
                                      <option value="<?=$s->name?>"><?=$s->name?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input id="upgrade" type="hidden" name="upgrade" value = 1 >
                        <input id="userId" type="hidden" name="userId" value ={{$user->id}}>
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