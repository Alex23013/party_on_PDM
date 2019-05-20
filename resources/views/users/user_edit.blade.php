@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
.p-top{
	padding-top: 2%;
}
#closeButton{
    visibility: hidden;
  }
#submitImageButtom{
 	visibility: hidden;
 }
#roleSelect{
	visibility: hidden;	
}
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
            <div class="box-header row  mm-left">
              <h3 class="box-title col-md-3 p-top" id="Title"> Datos del Usuario:<br>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  mm-left">
            	<div class="row">
	            	<div class="col-md-8">
	            	  	@if (Auth::user()->id == $user['id'])
	            		<form class="form-horizontal" role="form" method="POST" action="/users/profile/edit">
	            		@else
	            		<form class="form-horizontal" role="form" method="POST" action="/users/edit">
	            		@endif
		                {{ csrf_field() }}	              
		                <div class="col-md-8 "> 
		                  Nombre:  	                  
		                  <input type="text" class="form-control " name="name" placeholder="<?=$user['name']?>">
		                </div>
		                <div class="col-md-8 p-top "> 
		                  Apellido:  	                  
		                  <input type="text" class="form-control " name="last_name" placeholder="<?=$user['last_name']?>">
		                </div>
		                
		                <div class="col-md-8 p-top"> 
		                  Email:  	                  
		                  <input type="text" class="form-control " name="email" placeholder="<?=$user['email']?>">
		                </div>
		                @if($user['id'] == Auth::user()->id)
			                <div class="col-md-8 p-top"> 
			                  Celular:  	                  
			                  <input type="text" class="form-control " name="cellphone" placeholder="<?=$user['cellphone']?>">
			                </div>
		                @endif
		                @if (Auth::user()->role == "0" && $user['id'] != Auth::user()->id)
		                <div class="col-md-8 p-top"> 
		                  Rol: <?=$user['name_role']?> <br>
		                  <a onClick="roleSelectAppears();" ><i class="fa fa-edit"></i> Cambiar de Rol</a>  	                  
		                  <select id="roleSelect" type="text" class="form-control" name="role_parts">
                                    <option value="2,triaje"> Triaje</option>
                                    <option value="1,doctor"> Doctor</option>
                                    <option value="0,administrador" > Administrador </option>
                       		</select> 
                       		<input type="hidden" name="roleChange" id = "roleInput">
		                <br>
		                </div>
		                @else
		                <div class="col-md-8 p-top"> 
		                  Rol: <?=$user['name_role']?>
		                 </div>
		                @endif

		                @if (Auth::user()->id == $user['id'])
		                <div class="col-md-8 p-top"> 
		                <a onClick="closeAppears();" ><i class="fa fa-edit"></i> Cambiar contraseña</a> 
		                </div>
		                <div class="col-md-8 p-top " id = "closeButton"> 
		                  Nueva contraseña:  	                  
		                  <input type="text" class="form-control " name="password">
		                </div>

		                <br>
		                @endif

		                <input type="hidden" name="idUser" value = "<?=$user['id']?>">
		                <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>  Guardar cambios</button>
		                </form>
		                <br>
		                @if($user['id'] == Auth::user()->id)
			            	<a href="/profile"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
			            @else
			            	<a href="/users"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
			            @endif
	            	</div>
	            	
	            	
	            	<div class="col-md-4">
			            <img src="{{$url_image}}" style="width:200px; height:200px; border-radius: 120px;">
			            <br><br>
			            @if (Auth::user()->id == $user['id'])
			            <a onClick="submitImageAppears();" ><i class="fa fa-edit"></i> Actualizar Imagen de Perfil</a> 

			            <form enctype="multipart/form-data" action="/users/image_profile/edit" method="POST" id = "submitImageButtom" >
			                {{ csrf_field() }}	
			                <input type="file" name="avatar">
			                <br> 
			                <input type="submit" class="btn btn-primary" value="Subir Imagen">
			                
			            </form>
			            @endif
			        </div>
	            </div>
            </div>
      <!-- /.box-body -->
    </div>
  </div>
</div> 
@endsection