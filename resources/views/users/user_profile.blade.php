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
  .subtitle{
    padding-bottom: 1%;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
        <div class="box-body p-left">
          @if (Auth::user()->id == $user['id'])
            <h2> Mi Perfil<br></h2>
          @else
            <h2> Información de usuario {{$user['name_role']}} <br></h2>
          @endif
          <div class="col-md-8 ">
            <div class="col-md-12" >
              <span class="col-md-4"> Nombre: </span>
              <label  class="col-md-8">{{$user->name}} </label>
            </div>
            <div class="col-md-12" >
              <span class="col-md-4"> Apellido: </span>
              <label  class="col-md-8">{{$user->last_name}} </label>
            </div>
            <div class="col-md-12" >
              <span class="col-md-4"> DNI: </span>
              <label  class="col-md-8">{{$user->dni}} </label>
            </div>
            <div class="col-md-12" >
              <span class="col-md-4"> Email: </span>
              <label  class="col-md-8">{{$user->email}} </label>
            </div>
            <div class="col-md-12" >
              <span class="col-md-4"> Celular: </span>
              <label  class="col-md-8">{{$user->cellphone}} </label>
            </div>
            <div class="col-md-12" >
              <span class="col-md-4"> Rol: </span>
              <label  class="col-md-8">{{$user->name_role}} </label>
            </div>
            @if ($user['role']!=0)
              <div class="col-md-12" >
                <h4><label class="col-md-11 subtitle">Información adicional por ser {{$user->name_role}}</label></h4>
              </div>
              @if ($user['role']==2)
                <div class="col-md-12" >
                  <span class="col-md-4"> Es médico: </span>
                  @if($s_user->is_a_doctor)
                    <label  class="col-md-8"> Si </label>
                  @else
                    <label  class="col-md-8"> No </label>
                  @endif
                </div>
                <div class="col-md-12" >
                  <span class="col-md-4"> Colegiatura: </span>
                  @if($s_user->college)
                  <label  class="col-md-8"> {{$s_user->college}} </label>
                  @else
                  <label  class="col-md-8"> No tiene </label>
                  @endif
                </div>
              @endif
              @if ($user['role']==3  || $user['role']==1 ) 
              <div class="col-md-12" >
                <span class="col-md-4"> Fecha de Nacimiento: </span>
                <label  class="col-md-8">{{$s_user->birth_at}} </label>
              </div>
              @if ($user['role']==3)
              <div class="col-md-12" >
                <span class="col-md-4"> Código del Paciente: </span>
                <label  class="col-md-8">{{$s_user->patient_code}} </label>
              </div>
              <div class="col-md-12" >
                <span class="col-md-4"> Género: </span>
                @if ($s_user->genre == 1)
                  <label  class="col-md-8"> Masculino </label>
                @else
                  <label  class="col-md-8"> Femenino </label>
                @endif
              </div>
              @endif
              @if ($user['role']==1)
                <div class="col-md-12" >
                  <span class="col-md-4"> Dirección: </span>
                  <label  class="col-md-8">{{$s_user->address}} </label>
                </div>
                <div class="col-md-12" >
                  <span class="col-md-4"> Colegiatura: </span>
                  @if($s_user->college)
                    <label  class="col-md-8"> {{$s_user->college}} </label>
                  @else
                    <label  class="col-md-8"> No tiene </label>
                  @endif
                </div>
                <div class="col-md-12" >
                  <span class="col-md-4"> Especialidad: </span>
                  <label  class="col-md-8">{{$s_user->specialty}} </label>
                </div>
                <div class="col-md-12" >
                  <span class="col-md-4"> Disponible: </span>
                  @if($s_user->available)
                    <label  class="col-md-8"> Si </label>
                  @else
                    <label  class="col-md-8"> No </label>
                  @endif
                </div>
              @endif
              <div class="col-md-12" >
                <h4> <label class="col-md-11 subtitle">Información adicional del contacto de emergencia</label></h4>
              </div>
              <div class="col-md-12" >
                <span class="col-md-4"> Nombre del contacto: </span>
                <label  class="col-md-8">{{$s_user->ec_name}} </label>
              </div>
              <div class="col-md-12" >
                <span class="col-md-4"> Apellido del contacto: </span>
                <label  class="col-md-8">{{$s_user->ec_last_name}} </label>
              </div>
              <div class="col-md-12" >
                <span class="col-md-4"> Celular del contacto: </span>
                <label  class="col-md-8">{{$s_user->ec_cellphone}} </label>
              </div>
              @endif
            @endif
          </div>

          <div class="col-md-4 ">
              <img src="{{$url_image}}" class= "imgAvatar">
          </div> 
          <div class="col-md-12">
              <div class="col-md-4"></div>
              @if ($user->id == Auth::user()->id)
                <a href="/users/profile/edit">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Usuario</button></a>
                @if ($s_user)
                  <a href="/users/especific/edit"> <button class="btn  btn-flat bg-olive m-left">  <i class="fa fa-edit"></i> Editar información de <?=$user['name_role']?> </button> </a>
                @endif
              @endif
          </div>   
        </div>
        <!-- /.box-body -->
    </div>
</div>
@endsection