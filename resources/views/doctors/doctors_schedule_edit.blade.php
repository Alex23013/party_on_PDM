@extends('layouts.template')

@section('content')
<style type="text/css">
.mm-left{
    margin-left: 3%;
  }
.m-quarter-left{
  margin-left: 25%;
}
</style>

<div class="row">
  	<div class="col-xs-12">
    	<div class="box">
	        <div class="box-header mm-left ">
          <h3 class="box-title ">Información del horario de {{$doctor_name}}</h3>
        </div>
        <div class="box-body mm-left"> 
        <div class="col-md-12">
          <h4> Tipo de jornada</h4>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="/doctors/schedule/edit">
        <h4 class="mm-left">{{$doctor_name}} es un doctor : </h4>
              
            @if($doctor->all_day)
              
              <div class = "col-md-7 m-quarter-left">
               <input type="radio" id="all_day" name="all_day" value = "1" checked> a <b> tiempo completo </b>
              </div>
                   <br>  
              <div class = "col-md-6 m-quarter-left">     
                <input type="radio" id="all_day" name="all_day" value = "0">
                <b> activo por horas </b>
              </div> 
            @else
              <div class = "col-md-6 m-quarter-left"> 
                <input type="radio" id="all_day" name="all_day" value = "1"> a <b> tiempo completo </b> </div>
              <div class = "col-md-6 m-quarter-left">          
                  <input type="radio" id="all_day" name="all_day" value = "0" checked>
                <div><b> activo por horas </b>  </div> 
            @endif
       <div class="col-md-10">
          <h4> Horario semanal </h4> 
       </div>       
        
			 <table class="table table-striped">
                <thead>
                <tr>
	                  <th>Dia</th>
	                  <th>Inicio</th>
	                  <th>Fin</th>
	            </tr>
                </thead>
                <tbody>
                
                <?php foreach ($content_schedule as $user): ?>
                <tr>                
	                <td >
	                @if($user->schedule_start != '')
	                <input type="checkbox" id="days" name="days[]" value="<?=$user->day?>" checked>
	                @else
	                <input type="checkbox" id="days" name="days[]" value="<?=$user->day?>">
	                @endif
                  <span ><?=$user->day?></span>
	                </td>
	                <td>
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                      <div class="col-md-1">
                            <i class="fa fa-clock-o"></i>
                          </div>
                         <div class="col-md-6">
                         @if($user->schedule_start!='')
                            <input id="schedule_start" type="text" class="form-control " name="starts[]" placeholder="{{$user->schedule_start}}">
                        @else
                         <input id="schedule_start" type="text" class="form-control timepicker" name="starts[]" placeholder="{{$user->schedule_start}}">
                        @endif
                            </div>
                        </div>
                    </div>
                        @if($user->schedule_start!='')
                        <input type="hidden" name="real_starts[]" value = "{{$user->schedule_start}}">
                        @else
                         <input type="hidden" name="real_starts[]" value = "">
                        @endif

	                </td>
	                <td>
	                <div class="bootstrap-timepicker">
                        <div class="form-group">
                          
                         <div class="col-md-6">
                            @if($user->schedule_end!='')
                            <input id="schedule_end" type="text" class="
                            form-control " name="ends[]" placeholder="{{$user->schedule_end}}">
                            @else
                             <input id="schedule_end" type="text" class="form-control timepicker" name="ends[]" placeholder="{{$user->schedule_end}}">
                            @endif
                          </div>
                          <div class="col-md-1">
                            <i class="fa fa-clock-o"></i>
                          </div>
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
                <a href="/doctors/schedule/detail/{{$doctor->id}}"> <button class="btn  btn-flat btn-danger">  <i class="fa fa-close"></i> Descartar cambios</button></a>
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
      showSeconds: false,
      showMeridian:false
    })

    }); 
</script>
@endsection
