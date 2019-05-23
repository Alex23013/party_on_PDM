@extends('layouts.template')

@section('content')
<style type="text/css">
  .p-left{
    padding-left: 5%;
  }
  .p-top{
    margin-top: 1%;
  }
</style>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body p-left">
        <h3> Información de la Cita médica</h3>
        <form class="form-horizontal" role="form" method="POST" action="/appointments/edit">
      <br>
      <div class="col-md-8">
        <div class="col-md-12" >
          <label class="col-md-2"> Motivo: </label>
          <div  class="col-md-8">
              <textarea class="form-control" name = "motive" rows="2" placeholder="Describa el problema"></textarea>
          </div>
        </div>

        <div class="col-md-12 p-top" >
          <label class="col-md-2"> Dirección: </label>
          <div class="col-md-8">
              <input id="address" type="text" class="form-control" name="address" placeholder="{{$attention->address}}">
          </div>
        </div>

        <div class="col-md-12 p-top" >
          <label class="col-md-2"> Referencia: </label>
          <div class="col-md-8">
              <input id="reference" type="text" class="form-control" name="reference" placeholder="{{$attention->reference}}">
          </div>
        </div>

        <div class="col-md-12" >
            <h4>
              <label class="col-md-11 subtitle">Detalles de la cita médica</label>
            </h4>
          </div>

          <div class="col-md-12" >
            <label class="col-md-3"> Doctor: </label>
            <div class="col-md-8">
            </div>
          </div>

          <div class="col-md-12" >
            <label class="col-md-3"> Fecha de la cita: </label>
          </div>

          <div class="col-md-12" >
            <label class="col-md-3"> Estado: </label>
          </div>
      </div>

      <div class="col-md-4 ">
          <img src="/images/medic_date.png" style="width:100%;">  
      </div>  
        <div class="col-md-12 ">
          <div class="col-md-4 "></div>
          <div class="col-md-4 ">
            <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>    Guardar cambios  </button>   
          </div>
          </fo  rm>
          <div class="col-md-4 ">
          <a href="/appointments"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
          </div>
        </div>      
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection