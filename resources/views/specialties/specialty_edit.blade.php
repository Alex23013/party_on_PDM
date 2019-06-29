@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar una Especialidad </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/specialties/edit">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label" >Nombre *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder ="{{$esp->name}}" >
                                <b>* Campo Obligatorio</b>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="name" class="col-md-4 control-label" >Color</label>

                          <div class="col-md-5 " style="border-radius: 10px; background-color: {{$esp->color}};
                          color: {{$esp->color}};"> Color
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nuevo Color
                            </label>
                            <div class="col-md-5 " style="border-radius: 10px; background-color: {{$esp->color}};
                            color: {{$esp->color}};" id= "add-new-event">Color 
                            </div>
                            <input id="input-color" type="hidden" name="color">
                        </div>
                        <input type="hidden" name="id" value="{{$esp->id}}">
                        <div class="form-group">
                          <div class="col-md-10 btn-group col-md-offset-4" style="width: 50%;">
                                <ul class="fc-color-picker" id="color-chooser">
                                  <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>                     
                                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                  <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" >
                                    <i class="fa fa-btn fa-user"></i> Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('specific scripts')
<script type="text/javascript" >
    $(function () {

$('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor,'color': currColor });
      $('#input-color').val(currColor);
       console.log(currColor)
    })
 }); 
</script>
@endsection