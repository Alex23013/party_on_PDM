@extends('layouts.template')

@section('content')
<style type="text/css">
  #new_group_input{
    visibility: hidden;
  }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Añadir un medicamento</div>
                <div class="panel-body">
                @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                @endif
                    <form class="form-horizontal" role="form" method="POST" action="/medicines/add">
                         {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nombre *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand" class="col-md-4 control-label">Marca *</label>

                            <div class="col-md-6">
                                <input id="brand" type="text" class="form-control" name="brand" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dosis" class="col-md-4 control-label">Dosis *</label>

                            <div class="col-md-6">
                                <input id="dosis" type="text" class="form-control" name="dosis" placeholder="ejm: 15mg/5ml" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="presentation" class="col-md-4 control-label">Presentación *</label>

                            <div class="col-md-6">
                                <select class="form-control" id ="presentation_selector" name = "presentation" >
                                <option value=""> Seleccione una presentación </option>
                                  <option value="Tableta">Tableta</option>
                                  <option value="Jarabe">Jarabe</option>
                                  <option value="Ampolla">Ampolla</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="medicine_group" class="col-md-4 control-label">Grupo *</label>

                            <div class="col-md-6">
                                <select class="form-control" id ="selector" name = "medicine_group" >
                                <option value=""> Seleccione un grupo </option>
                                @foreach($groups as $gr)
                                  <option value="<?=$gr['id']?>"><?=$gr['group_name']?></option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                        <div class="col-md-2 col-md-offset-3">
                          <button type="button" class="btn btn-primary" id="buttonAdd">
                              <i class="fa fa-btn fa-plus"></i> Añadir grupo
                          </button>
                          </div>
                          <div class="col-md-4 col-md-offset-1">
                                <input type="text" class="form-control" id = "new_group_input" name="medicine_group" >
                                <input type="hidden" id = "new_group" name="new_group" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <a href="/medicines">
                                <button type="button" class="btn btn-danger" >
                                    <i class="fa fa-btn fa-close"></i> Cancelar
                                </button>
                                </a>
                                
                                <button type="submit" class="btn btn-success" >
                                    <i class="fa fa-btn fa-save"></i> Añadir medicamento
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
      var group_input = document.getElementById("new_group_input");
      
      $( "#buttonAdd" ).click(function() {
        group_input.style.visibility = 'visible';
        group_input.disabled=false;
        document.getElementById("selector").value = "";
        document.getElementById("new_group").value = 1;
      }); 

      $('#selector').change(function(){
        group_input.value = "";
        group_input.disabled=true;
        document.getElementById("new_group").value = 0;
      });
 }); 
</script>
@endsection