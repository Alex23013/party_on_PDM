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
		        <div class="col-md-12 m-top">
		        	<ul> 
		          <?php foreach ($doctors as $doc): ?>
		            <li>
		             <!--<button  type="button" class="btn btn-danger " onclick="return confirm('¿Estas seguro que quieres desmarcar este kit para este doctor?');"><i class="fa fa-times"></i>
		             </button>--> {{$doc['name']}}
		            </li> 		
		            <!--TODO: agregar el select para asignar este kit a un doctor-->             
		          <?php endforeach ?> 
		          </ul>
		          </div> 
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