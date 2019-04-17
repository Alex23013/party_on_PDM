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
              <li> Nombre: <b><?=$user['name']?></b></li>
              <li> Apellido: <b><?=$user['last_name']?></b></li>
              <li> DNI: <b><?=$user['dni']?></b></li>
              <li> Email: <b><?=$user['email']?> </b></li>
              <li> Celular: <b><?=$user['cellphone']?></b></li>
              <li> Rol: <b> <?=$user['name_role']?> </b></li>

              @if ($user['role']==1)
                <br>
                <b>Información adicional por ser <?=$user['name_role']?> </b>
                <li> Fecha de Nacimiento: <b> {{$s_user->birth_at}} </b></li>
                <li> Dirección: <b> {{$s_user->address}} </b></li>
                <li> Colegiatura: <b> 
                @if($s_user->college)
                <?=$s_user->college?>  
                @else
                No tiene
                @endif 
                </b></li>
                <li> Especialidad: <b> <?=$s_user->specialty?> </b></li>
                <li> Disponible: <b> 
                @if($s_user->available)
                Si
                @else
                No
                @endif 
                </b></li>
                <br>
                <b>Información adicional del contacto de emergencia </b>
                <li> Nombre del contacto: <b><?=$s_user->ec_name?></b></li>
                <li> Apellido del contacto: <b><?=$s_user->ec_last_name?></b></li>
                <li> Celular del contacto: <b> {{$s_user->ec_cellphone}}</b></li>
              @endif
              
              @if ($user['role']==2)
              <br>
              <b>Información adicional por ser de <?=$user['name_role']?> </b>
              <li> Es médico: <b> 
                @if($s_user->is_a_doctor)
                Si
                @else
                No
                @endif 
              </b></li>
              <li> Colegiatura: <b> 
                @if($s_user->college)
                {{$s_user->college}}  
                @else
                No tiene
                @endif 
              </b></li>
              @endif
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