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
            <h2>Mis Solicitudes de Servicios DocDoor</h2>
            <br>
            <a href="/patients/services">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-plus"></i>  Añadir una Solicitud</h5>
                </button>
              </a>
          </div>
            <!-- /.box-header -->
            <div class="box-body ">
            @if ($new)
            <div class="alert alert-success alert-dismissible pTop" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4>Nueva solicitud</h4>
            </div>
          @endif
          <div id="alertsuccess"></div>	
              <table class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
                  <th>Fecha pedido</th>
                  <th>Servicio</th>
                  <th>Asociado</th>
                  <th>Estado</th>
                  <th>Proceso</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($dservices as $d_service): ?>
                    <tr>  
                    <td><?=$d_service['created_at']?></td>
                    <td><?=$d_service['service_name']?></td>
                    <td><?=$d_service['partner_name']?></td>
                    @if ($d_service['payment_status'] == 1)
                      <td>Pagado</td>
                    @else
                      <td>Falta Pagar </td>
                    @endif
                    @if ($d_service['complete'] == 1)
                      <td>Atendido</td>
                    @else
                      <td>Pendiente </td>
                    @endif
                    <td> 
                      <a href="/d_services/detail/{{$d_service['id']}}" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
                      @if ($d_service['payment_status'] == 1)
                      <button class="btn btn-info btn-flat buttonSpace buyButton disabled" ><i class="fa  fa-suitcase"></i> Pagar</button>
                      @else
                      <button class="btn btn-info btn-flat buttonSpace buyButton" data-description="{{$d_service['service_name']}} con el Proveedor {{$d_service['partner_name']}}" data-cost= "{{$d_service['cost']}}" data-tokenPay = "{{$d_service['token_pay']}}"><i class="fa  fa-suitcase"></i> Pagar</button>
                      @endif
                       
                      <a href="/d_services/remove/{{$d_service['id']}}" title="Eliminar" > <button  type="button" class="btn btn-danger btn-flat buttonSpace " onclick="return confirm('¿Estas seguro de que quieres eliminar esta solicitud de servicio DocDoor?');"><i class="fa fa-trash"></i></button><a>
                    </td>
                    </tr>  
                    <?php endforeach ?>  
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
        

@endsection