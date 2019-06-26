@extends('layouts.template')

@section('content')

<style type="text/css">
  #Title{
    padding-top: 15px;
    padding-bottom: 15px
  }
  .p-top{
    padding-top: 15px;
  }
  .colorEvent{
    margin-top: 15px;
    border-radius: 10px;
    background-color: {{$schedule->color}};
    color: {{$schedule->color}};
    margin-left: 20px;
  }
  .m-left{
    margin-left: 25%;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
            <div class="box-header m-left">
              <div class="col-md-1 colorEvent"> Color del evento </div>
              <h3 class="box-title col-md-10 " id="Title"> Horario de atención:<br>
              <b>{{$doctor_name}}</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              <div class="col-md-8 m-left">
                <div class="col-md-12" >
                  <span class="col-md-4"> Fecha: </span>
                  <label  class="col-md-8">{{$schedule->date}} </label>
                </div>
                <div class="col-md-12" >
                  <span class="col-md-4"> Hora inicio: </span>
                  <label  class="col-md-8">{{$schedule->start_time}} </label>
                </div>
                <div class="col-md-12" >
                  <span class="col-md-4"> Hora fin: </span>
                  <label  class="col-md-8">{{$schedule->end_time}} </label>
                </div>
              </div>

              <div class="col-md-12 m-left">
                <div class="col-md-8 ">
                  <a href="/edoctors/schedule">  
                    <button type="button" class="btn bg-purple margin">  <i class="fa fa-arrow-left"></i>  Regresar al calendario</button>
                  </a>
                  <a href="/edoctors/schedule/remove/{{$schedule->id}}">
                    <button class="btn  btn-flat btn-danger">  <i class="fa fa-trash"></i> Eliminar horario de Atención</button>
                  </a>
                </div>
              </div> 
              
            </div>
            <!-- /.box-body -->
          </div>
  </div>
</div>

      
	
@endsection