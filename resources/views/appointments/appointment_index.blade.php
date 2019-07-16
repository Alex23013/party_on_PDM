 @extends('layouts.template')

@section('content')
        <div class="row">
        <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header mm-left ">
            <h2>Lista de Citas de DocDoor</h2>
            <br>
            <a href="/appointments/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-plus"></i>  Añadir una Cita médica</h5>
                </button>
              </a>
            <a href="/patients/add/1">  
                <button type="button" class="btn  bg-purple margin">
                 <h5 ><i class="fa fa-user-plus"></i>  Registrar a  un Paciente</h5>
                </button>
              </a>
          </div>
            <!-- /.box-header -->
            <div class="box-body ">
            @if ($new)
            <div class="alert alert-success alert-dismissible pTop" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4>Nueva cita añadida </h4>
            </div>
          @endif
          <div class="col-xs-12">
              <table  class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
                  <th>Código de Atención</th>
                  <th>Paciente</th>
                  <th>DNI</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                
                <?php foreach ($info as $app): ?>
                    <tr>  
                    <td>{{$app['attention_code']}}</td>
                    <td>{{$app['patient']}}</td>
                    <td>{{$app['patient_dni']}}</td>
                    <td>{{$app['status']}}</td>
                    <td> 
                      <a href="/appointments/detail/{{$app['id']}}" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
                      <a href="/appointments/remove/{{$app['id']}}" title="Eliminar"><button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar esta cita médica?');"><i class="fa fa-trash"></i></button><a>
                      <a href="/appointments/update_status/{{$app['app_id']}}/1" title="Confirmar Cita" > <button  type="button" class="btn btn-success btn-flat buttonSpace" onclick="return confirm('¿Estas seguro que quieres confirmar esta cita médica?');"><i class="fa fa-check"></i></button></a>
                      <a href="/appointments/update_status/{{$app['app_id']}}/3" title="Cancelar Cita" > <button  type="button" class="btn btn-danger btn-flat buttonSpace" onclick="return confirm('¿Estas seguro que quieres canceladar esta cita médica?');"><i class="fa fa-ban"></i></button></a>
                    </td>
                    </tr>  
                    <?php endforeach ?>  
                  
                
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
        

@endsection