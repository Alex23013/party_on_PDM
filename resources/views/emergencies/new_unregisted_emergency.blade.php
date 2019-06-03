@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar una Emergencia de un usuario <b> NO REGISTRADO </b></div>
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
                    <form class="form-horizontal" role="form" method="POST" action="/u/emergency">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="p_name" class="col-md-4 control-label">Nombre del paciente * </label>
                            <div class="col-md-6">
                                <input id="p_name" type="text" class="form-control" name="p_name" >
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="p_last_name" class="col-md-4 control-label">Apellido del paciente * </label>
                            <div class="col-md-6">
                                <input id="p_last_name" type="text" class="form-control" name="p_last_name" >
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="p_dni" class="col-md-4 control-label">DNI del paciente *</label>
                            <div class="col-md-6">
                                <input id="p_dni" type="text" class="form-control" name="p_dni" >
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="p_cell" class="col-md-4 control-label">Celular del paciente *</label>
                            <div class="col-md-6">
                                <input id="p_cell" type="text" class="form-control" name="p_cell" >
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label for="motive" class="col-md-4 control-label">Motivo  *</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name = "motive" rows="3" placeholder="Describa el problema"></textarea>
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
                            <label for="reference" class="col-md-4 control-label">Referencia </label>

                            <div class="col-md-6">
                                <input id="reference" type="text" class="form-control" name="reference" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Información de la persona que está llamando (opcional)</label>
                        </div>

                        <div class="form-group">
                            <label for="caller_name" class="col-md-4 control-label">Nombre  </label>

                            <div class="col-md-6">
                                <input id="caller_name" type="text" class="form-control" name="caller_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="caller_last_name" class="col-md-4 control-label">Apellido </label>

                            <div class="col-md-6">
                                <input id="caller_last_name" type="text" class="form-control" name="caller_last_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="caller_dni" class="col-md-4 control-label">DNI </label>

                            <div class="col-md-6">
                                <input id="caller_dni" type="text" class="form-control" name="caller_dni" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="caller_cell" class="col-md-4 control-label">Celular  </label>

                            <div class="col-md-6">
                                <input id="caller_cell" type="text" class="form-control" name="caller_cell" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-8 control-label">Información de un contacto adicional (opcional) </label>
                        </div>

                        <div class="form-group">
                            <label for="oc_name" class="col-md-4 control-label">Nombre del contacto</label>

                            <div class="col-md-6">
                                <input id="oc_name" type="text" class="form-control" name="oc_name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="oc_cell" class="col-md-4 control-label">Celular del contacto</label>

                            <div class="col-md-6">
                                <input id="oc_cell" type="text" class="form-control" name="oc_cell" >

                            </div>
                        </div>
                         <div class="form-group">
                            <label for="oc_relationship" class="col-md-4 control-label">Relación con el paciente</label>

                            <div class="col-md-6">
                                <input id="oc_relationship" type="text" class="form-control" name="oc_relationship" >

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
