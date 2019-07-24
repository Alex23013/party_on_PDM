@extends('layouts.template')

@section('content')
<style type="text/css">
  .p-left{
    padding-left: 5%;
  }
  .m-top{
  	margin-top: 5px;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body p-left">
	      <h3> Información del Kit<br></h3>
	      <div class="col-md-6">
	        <div class="col-md-12" >
	          <span class="col-md-3"> Nombre: </span>
	          <label  class="col-md-9">{{$kit->name}} </label>
	        </div>
	        <div class="col-md-12">
		        <h4>Medicinas que lo componen</h4>
		        <div class="col-md-12 m-top">
		        	<ul> 
		          <?php foreach ($medicines as $med): ?>
		            <li>
		             <!--<button  type="button" class="btn btn-danger " onclick="return confirm('¿Estas seguro que quieres eliminar esta medicina del kit?');"><i class="fa fa-times"></i>
		             </button>--> {{$med['quantity']}} {{$med['name']}} - {{$med['brand']}} 
		            </li> 		             
		          <?php endforeach ?>  
		          </ul>
		          </div> 
		      </div>
		      <div class="col-md-12">
		        <h4>Doctores que lo usan</h4>
		          <?php foreach ($doctors as $doc): ?>
		        	<div class="col-md-8 m-top">    
		              {{$doc['name']}} 
		          </div>
							<div class="col-md-4 m-top"> 
		          <a href="/kits/removeDoctorkit/{{$doc['doctor_id']}}/{{$kit->id}}"><button  type="button" class="btn btn-danger " onclick="return confirm('¿Estas seguro que quieres desmarcar este kit para este doctor?');"><i class="fa fa-times"></i>
		             </button></a>
		          </div>
		          <?php endforeach ?> 
		      </div>
		      <div class="col-md-12 m-top">
		      <form class="form-horizontal" role="form" method="POST" action="/kits/addDoctorkit">
                    {{ csrf_field() }}
              <div class="col-md-4 ">
                <div class="form-group">                   
                    <select class="form-control" name = "user_id" >
                    @foreach($all_doctors as $user)
                      <option value="<?=$user->id?>">{{$user->name}} {{$user->last_name}} </option>
                    @endforeach
                    </select>    
                </div>
              </div>
              <input type="hidden" name="kit_id" value ={{$kit->id}}>
            <div class="col-md-2">
               <button type="submit" class="btn  btn-flat btn-success" onclick="return confirm('¿Estas seguro que quieres asignar este doctor a este kit?');">  <i class="fa fa-plus"></i>  Asignar este kit</button>
            </div>
          </form>
          </div>
		      <div class="col-md-6 col-md-offset-4">
              <br>
                <a href="/kits"> <button class="btn  btn-flat bg-olive m-left">  Volver a la lista de kits</button>
                </a>
          </div>
	      </div>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection

@section('specific scripts')
<script type="text/javascript" >
</script>
@endsection