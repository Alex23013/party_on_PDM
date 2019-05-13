@extends('layouts.template')

@section('content')
<style type="text/css">
  .imgAvatar {
    width:200px;
    height:200px;
    border-radius:150px;
  }
  .p-left{
    padding-left: 5%;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body p-left">
      <h3> Información de la Solicitud<br></h3>
      <div class="col-md-8 p-top">
      <ul>
        <li> Paciente: <b>{{$user->name}}</b></li>
        <li> Servicio: <b>{{$service->service_name}}</b></li>
        <li> Asociado: <b>{{$partner->partner_name}}</b></li>
        <li> Dirección de salida: <b>{{$data->address_from}}</b></li>
        <li> Dirección de llegada: <b>{{$data->address_to}}</b></li>
        <li> Fecha de solicitud: <b>{{$data->created_at }}</b></li>
        <li> Fecha de ejecución: @if($data->execution)
          <b>{{$data->execution}}</b>
        @else
          <b>Aun no se realizó</b>
        @endif</li>
        <li> Fecha de entrega de resultados:
         @if($data->delivery)
          <b>{{$data->delivery}}</b>
        @else
         <b> Aun no se entregó resultados </b>
        @endif
         </li>
        <li> Estado: 
        @if($data->execution)
          <b>Completado</b>
        @else
          <b>Incompleto</b>
        @endif
        </li>        
      </ul>

        <a href="/d_services/edit/{{$data->id}}">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Solicitud</button></a>
        
        </div>
        <div class="col-md-4 ">
            <img src="/images/solicitud.svg" class= "imgAvatar">
        </div>    
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection