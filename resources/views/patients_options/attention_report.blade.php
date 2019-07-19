@extends('layouts.template')

@section('content')	
<style type="text/css">
	#header-title{
		padding-left: 10%;
		padding-top: 2%;
	}
	#header-text{
		padding-top: 2%
	}
	.bg-gray{
		background-color: #eaeae1;
	}
	.space{
		margin-top: 20px;
	}
	table {
	  border-collapse: collapse;
	}
	td {
		border: 1px solid #000000;
		padding: 10px;
	}

</style>
<div class="row">
	<div class="col-xs-12">
  	<div class="box"> 
  		<div class="box-header">
  			<div class="col-md-3">
  				<img src="/images/logos/logo-main-side-bar.png" style="width: 100%;">
  			</div>
  			<div class="col-md-6" id = "header-title"> <h2>REPORTE DE ATENCION</h2></div>
  			<div class="col-md-3" id = "header-text">
  				<span>Código: FOR-DD-001 <br>
								Versión: 00<br>
								Vigencia: Jun 2018</span>
  			</div>  			
  		</div>
  		<div class="box-body ">
  				<table class="col-md-10 col-md-offset-1 bg-gray">
					  <tr>
					    <td><b> Reporte N°: </b> 001 – 2018</td>
					    <td><b>Fecha de Atención:</b> 27 de setiembre de 2018</td>
					  </tr>
					</table>
					<div class="space col-md-12">  </div>
					<table class="col-md-12 bg-gray">
					  <tr>
					    <td><b>ATENCIÓN LOCALIZADA </b></td>
					    <td><b>TRASLADO EN AMBULANCIA</b></td>
					    <td><b>ATENCIÓN EN CONSULTORIO</b></td>
					    <td><b>OTROS</b></td>
					  </tr>
					</table>

  		</div>	
  	</div>
  </div>
</div>

@endsection