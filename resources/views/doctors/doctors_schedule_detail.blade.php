@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
</style>

<div class="row">
  	<div class="col-xs-12">
    	<div class="box ">
        <div class="box-header mm-left ">
          <h3 class="box-title ">Información del horario de {{$name}}</h3>
        </div>
	      <div class="box-body mm-left"> 
        <h4> Tipo de jornada</h4>
        <h5 class="mm-left">{{$name}} es un doctor   
            @if($doctor->all_day)
              a <b> tiempo completo </b>
            @else
              <b> activo por horas </b>
            @endif</h5>
        <h4> Horario semanal </h4>
			    <table class="table table-striped col-xs-10">
                <thead>
                <tr>
	                  <th>Dia</th>
	                  <th>Inicio</th>
	                  <th>Fin</th>
	            </tr>
                </thead>
                <tbody>
                <?php foreach ($schedules as $user): ?>
                <tr>                
	                <td><?=$user->day?></td>
	                <td><?=$user->schedule_start?></td>
	                <td><?=$user->schedule_end?></td>
	             <?php endforeach ?>
	            </tr>
                </tbody>
          </table>
          <a href="/doctors/schedule/edit/{{$doctor->id}}">  <button type="button" class="btn bg-purple margin">  <i class="fa fa-edit"></i>  Editar Horario</button></a>
        </div>
          <!-- /.box-body -->
      </div>
  	</div>
</div>
@endsection