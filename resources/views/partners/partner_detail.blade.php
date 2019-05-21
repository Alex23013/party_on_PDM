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
  <div class="col-md-12">
    <div class="box">
      <div class="box-body p-left">
      <h3> Información del Asociado<br></h3>
      <div class="col-md-6">
        <div class="col-md-12" >
          <span class="col-md-6"> Nombre: </span>
          <label  class="col-md-6">{{$user->partner_name}} </label>
        </div>

        <div class="col-md-12">
          <span class="col-md-6"> Rubro: </span>
          <label  class="col-md-6">{{$user->sector}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> Razón Social: </span>
          <label  class="col-md-6">{{$user->social_reason}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> RUC: </span>
          <label  class="col-md-6">{{$user->ruc}}</label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> Celular 1: </span>
          <label  class="col-md-6">{{$user->cell_1}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> Celular 2: </span>
          <label  class="col-md-6">{{$user->cell_2}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> Dirección: </span>
          <label  class="col-md-6">{{$user->address}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> Horario de Atención: </span>
          <label  class="col-md-6">{{$user->hours_of_operation}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6">  Número de Cuenta Corriente: </span>
          <label  class="col-md-6">{{$user->current_acount}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> Página web: </span>
          <label  class="col-md-6">{{$user->web_page}} </label>
        </div>
        <div class="col-md-12" >
          <span class="col-md-6"> Email:: </span>
          <label  class="col-md-6">{{$user->email}} </label>
        </div> 
      </div> 
      <div class="col-md-3">
        <h4>Servicios ofrecidos</h4>
          <?php foreach ($name_services_arr as $name): ?>
             <div class="col-md-12">
             {{$name}}
             </div>
          <?php endforeach ?>  
      </div>
      
        <!--TODO: logo de la empresa a futuro -->
        <div class="col-md-3 ">
            <img src="/images/asociado.png" class= "imgAvatar">
        </div> 
        <div class="col-md-12">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        @if (Auth::user()->role == 0)
        <a href="/partners/edit/{{$user->id}}">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Asociado</button></a>
        <a href="/p_services/{{$user->id}}"> <button class="btn  btn-flat bg-olive m-left">  <i class="fa fa-edit"></i> Editar Servicios </button> </a>
        @endif
        </div>
        <div class="col-md-3"></div>
      </div>   
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection