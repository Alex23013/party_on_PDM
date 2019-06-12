@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
</style>

<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
	        <div class="box-header mm-left ">
	        	<h2>Lista de Provedores del servicio : {{$service->service_name}}</h2>
	        </div>
	        <!-- /.box-header -->
	        <div class="box-body "> 
			<div class="col-xs-12 ">
			 <table class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
	                  <th>Nombre del Proveedor</th>
	                  <th>Costo del servicio</th>
	                  <th>Comision DocDoor</th>
	                  <th>Solicitar servicio</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($matched_ps as $ps): ?>
	                  <tr>  
	                  <td>{{$ps['partner_name']}}</td>
	                  <td>{{$ps['service_cost']}}</td>
	                  <td>{{$ps['docdoor_cost']}}</td>
	                  <td>
	                  	<a href="/patients/add_dservices/{{$service->id}}/{{$ps['partner_id']}}" title="Solicitar servicio" > <button  type="button" class="btn btn-success btn-flat buttonSpace"><i class="fa  fa-calendar-check-o "></i></button></a>
	                  </td>
	                  </tr>  
	            <?php endforeach ?>                    
                </tbody>
              </table>
              </div>
	        </div>
            <!-- /.box-body -->
        </div>
  	</div>
</div>
@endsection