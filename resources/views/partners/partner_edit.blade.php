@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar información de un Asociado</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/partners/edit">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="{{$user->name}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sector" class="col-md-4 control-label">Rubro </label>

                            <div class="col-md-6">
                                <input id="sector" type="text" class="form-control" name="sector" placeholder="{{$user->sector}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="social_reason" class="col-md-4 control-label">Razón Social </label>

                            <div class="col-md-6">
                                <input id="social_reason" type="text" class="form-control" name="social_reason"  placeholder="{{$user->social_reason}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ruc" class="col-md-4 control-label">RUC </label>

                            <div class="col-md-6">
                                <input id="ruc" type="text" class="form-control" name="ruc" placeholder="{{$user->ruc}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Dirección </label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" placeholder="{{$user->address}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cell_1" class="col-md-4 control-label">Celular 1 </label>

                            <div class="col-md-6">
                                <input id="cell_1" type="text" class="form-control" name="cell_1" placeholder="{{$user->cell_1}}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cell_2" class="col-md-4 control-label">Celular 2</label>

                            <div class="col-md-6">
                                <input id="cell_2" type="text" class="form-control" name="cell_2" placeholder="{{$user->cell_2}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="hours_of_operation" class="col-md-4 control-label">Horario de atención</label>

                            <div class="col-md-6">
                                <input id="hours_of_operation" type="text" class="form-control" name="hours_of_operation" placeholder="{{$user->hours_of_operation}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="current_acount" class="col-md-4 control-label">Número de Cuenta Corriente</label>

                            <div class="col-md-6">
                                <input id="current_acount" type="text" class="form-control" name="current_acount" placeholder="{{$user->current_acount}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="web_page" class="col-md-4 control-label">Página web</label>

                            <div class="col-md-6">
                                <input id="web_page" type="text" class="form-control" name="web_page" placeholder="{{$user->web_page}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="{{$user->email}}" >
                            </div>
                        </div>
                        <input id="id" type="hidden" name="id" value = 
                         {{$user->id}}>           
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn  btn-flat btn-success m-left">  <i class="fa fa-save"></i>    Guardar cambios  </button> 
                            </div>
                    </form>
						<div class="col-md-6 col-md-offset-4">
						<br>
                    	  <a href="/partners"> <button class="btn  btn-flat btn-danger m-left">  <i class="fa fa-close"></i> Descartar cambios</button></a>
                    	</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection