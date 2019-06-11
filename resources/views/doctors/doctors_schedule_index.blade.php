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
	          <h2>Módulo de horarios de Médicos</h2>
	        </div>
	        <div class="box-body"> 
	        <div class="col-xs-12">
			 <table class="table table-bordered table-striped DataTable">
                <thead>
                <tr>
	                  <th>Nombre</th>
	                  <th>Apellido</th>
	                  <th>Celular</th>
	                  <th>Tipo de jornada</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
	                  <tr>  
	                  <td><?=$user->name?></td>
	                  <td><?=$user->last_name?></td>
	                  <td><?=$user->cellphone?></td>
	                  @if($user->all_day)
	                  <td> Jornada completa</td>
	                  @else
	                  <td> Activo por horas</td>
	                  @endif
	                  <td> 
	                  @if($user->schedule_id)
		                  <a href="/doctors/schedule/detail/{{$user->id}}" title="Ver detalles" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa fa-eye"></i></button></a>
		                  
		                  <a href="/doctors/schedule/edit/{{$user->id}}" title="Editar"> <button  type="button" class="btn btn-info btn-flat buttonSpace"><i class="fa fa-edit"></i></button></a>
	                  @else
	                  	  <a href="/doctors/schedule/assign/{{$user->id}}" title="Asignar horario" > <button  type="button" class="btn btn-primary btn-flat buttonSpace"><i class="fa  fa-calendar-plus-o"></i> Asignar horario</button></a>
	                  @endif
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