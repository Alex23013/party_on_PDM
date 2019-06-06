@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Hacer un llamado de emergencia</div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/patients/new_inbox">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="patient_id" class="col-md-4 control-label">Nombre del paciente *</label>

                            <div class="col-md-6">
                                <select class="form-control" name = "patient_id" >
                                    <option value=""> Seleccione un paciente </option>
                                    @foreach($users as $patient)
                                    <option value="<?=$patient['id']?>"><?=$patient['name']?></option>
                                    @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="motive" class="col-md-4 control-label">Motivo  *</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name = "message" rows="3" placeholder="Describa el problema"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="patient_cell" class="col-md-4 control-label">Celular * </label>

                            <div class="col-md-6">
                                <input id="patient_cell" type="text" class="form-control" name="patient_cell" >
                                 <b>Nota: Los campos con * son obligatorios</b>
                            </div>
                        </div>
                        <input type="hidden" name="type" value = 2>

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

