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
	          <h3 class="box-title ">Horario de {{$name}}</h3>
	        </div>
	        <div class="box-body mm-left"> 
			 <table class="table table-striped">
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