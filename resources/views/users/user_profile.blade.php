@extends('layouts.template')

@section('content')
<style type="text/css">
  .imgAvatar {
    width:200px;
    height:200px;
    border-radius:150px;
  }
  .p-top{
    padding-top: 3%;
  }
  .p-left{
    padding-left: 5%;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
            <div class="box-body p-left">
            <h2> Mi Perfil<br></h2>
            <div class="col-md-8 p-top">
            <ul>
              <li> Nombre: <b><?=$user['name']?></b></h3>
              <li> Apellido: <b><?=$user['last_name']?></b></h3>
              <br>FALTA PONER DATOS
              <li> Rol: <b> <?=$user['name_role']?> </b></li>
              <li> Email: <b><?=$user['email']?> </b></li>
            </ul>
              <a href="/users/{{$user->id}}/edit">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Usuario</button></a>
              </div>
              <div class="col-md-4 ">
                  <img src="{{$url_image}}" class= "imgAvatar">
              </div>    
            </div>
            <!-- /.box-body -->
          </div>
</div>
@endsection