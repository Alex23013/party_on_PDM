 @extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 2%;
  }
</style>

        <div class="row">
        <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header mm-left ">
            <h2>Lista de Emergencias de Docdoor</h2>
            <br>
            <a href="/emergency/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-plus"></i>  Añadir una Emergencia de usuario REGISTRADO </h5>
                </button>
            </a>
            <a href="/u/emergency/add">  
                <button type="button" class="btn  bg-purple margin">
                 <h5 ><i class="fa fa-plus"></i>  Añadir una Emergencia de usuario <b>SIN REGISTRAR</b></h5>
                </button>
              </a>
          </div>
            <!-- /.box-header -->
            <div class="box-body ">
            @if ($new)
            <div class="alert alert-success alert-dismissible pTop" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4>Nueva emergencia registrada </h4>
            </div>
          @endif
              <table id="example1" class="table table-bordered table-striped mm-left">
                <thead>
                <tr>
                  <th>Código de Atención</th>
                  <th>Paciente</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                
                <?php foreach ($emergencies as $emergency): ?>
                    <tr>  
                    <td>{{$emergency['attention_code']}}</td>
                    <td>{{$emergency['name']}}</td>
                    
                    <td> 
                      <a href="/emergency/detail/{{$emergency['attention_id']}}/{{$emergency['is_attention']}}" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
                      <a href="/emergency/remove/{{$emergency['attention_id']}}/{{$emergency['is_attention']}}" title="Eliminar" ><button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar esta emergencia?');"><i class="fa fa-trash"></i></button><a>
                    </td>
                    </tr>  
                    <?php endforeach ?>  
                  
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Paciente</th>
                  <th>Servicio</th>
                  <th>Asociado</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
        

@endsection


@section('specific scripts')
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "sSearch":"Busqueda"
    })
  })
</script>

@endsection