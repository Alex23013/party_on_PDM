@extends('layouts.template')

@section('content')
<style type="text/css">
  .imgAvatar {
    width:200px;
    height:200px;
    border-radius:150px;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body p-left">
      <h2> Datos del Asociado<br></h2>
      <div class="col-md-8 p-top">
      <ul>
        <li> Nombre: <b>{{$user->name}}</b></li>
        <li> Rubro: <b>{{$user->sector}}</b></li>
        <li> Razón Social: <b>{{$user->social_reason}}</b></li>
        <li> RUC: <b>{{$user->ruc}}</b></li>
        <li> Celular 1: <b>{{$user->cell_1}}</b></li>
        <li> Celular 2: <b>{{$user->cell_2}}</b></li>
        <li> Dirección: <b>{{$user->address}}</b></li>
        <li> Horario de Atención: <b>{{$user->hours_of_operation}}</b></li>
        <li> Número de Cuenta Corriente: <b>{{$user->current_acount}}</b></li>
        <li> Página web: <b>{{$user->web_page}}</b></li>
        <li> Email: <b>{{$user->email}} </b></li>
        
      </ul>

        <a href="/partners/edit/{{$user->id}}">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Asociado</button></a>
        <a href="#"> <button class="btn  btn-flat bg-olive m-left">  <i class="fa fa-edit"></i> Editar Servicios </button> </a>
        
        </div>
        <div class="col-md-4 ">
            <img src="/images/triaje.png" class= "imgAvatar">
        </div>    
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection