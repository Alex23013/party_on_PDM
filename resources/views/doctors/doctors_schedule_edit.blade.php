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
                <form class="form-horizontal" role="form" method="POST" action="/doctors/schedule/edit">
                <?php foreach ($schedules as $user): ?>
                <tr>                
	                <td><?=$user->day?>
	                @if($user->schedule_start != '')
	                <input type="checkbox" id="days" name="days[]" value="<?=$user->day?>" checked>
	                @else
	                <input type="checkbox" id="days" name="days[]" value="<?=$user->day?>">
	                @endif
	                </td>
	                <td>
	                <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <input id="address_from" type="text" class="form-control" name="starts[]" placeholder="{{$user->schedule_start}}">
                        </div>
                        @if($user->schedule_start!='')
                        <input type="hidden" name="real_starts[]" value = "{{$user->schedule_start}}">
                        @else
                      <input type="hidden" name="real_starts[]" value = "">
                        @endif

                     </div>
	                </td>
	                <td>
	                <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <input id="address_from" type="text" class="form-control" name="ends[]" placeholder="{{$user->schedule_end}}">
                        </div>
                     </div>
                     @if($user->schedule_end!='')
                        <input type="hidden" name="real_ends[]" value = "{{$user->schedule_end}}">
                     @else
                      <input type="hidden" name="real_ends[]" value = "">
                      @endif
	                </td>
	             <?php endforeach ?>
	            </tr>
	            <input type="hidden" name="doctor_id" value = "{{$doctor->id}}">

                <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>  Guardar cambios</button>
                </form>
                <a href="/doctors/schedule/detail/{{$doctor->id}}"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
                </tbody>
              </table>
	        </div>
            <!-- /.box-body -->
        </div>
  	</div>
</div>
@endsection

@section('specific scripts')
<script type="text/javascript" >
    $(function () {

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showSeconds:true,
      showMeridian:false
    })

    }); 
</script>