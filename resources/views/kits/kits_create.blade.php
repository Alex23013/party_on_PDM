@extends('layouts.template')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-1">
    <div class="panel panel-default">
      <div class="panel-heading">Registrar un Kit</div>
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
        <form class="form-horizontal" role="form" method="POST" action="/kits">
             {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">Nombre *</label>
                <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="name" >
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-2 control-label">Medicinas *</label>
                <div class="col-md-8">
                	@foreach($medicines as $med)
                    <input type="checkbox" name="medicines[]" value="<?=$med->id?>" > {{$med->name}} - {{$med->brand}} {{$med->dosis}} 
                     <br><b> Cantidad </b>
                    <input type="text" name="med_quantity[]" >
                    <br>
                  @endforeach
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
@endsection