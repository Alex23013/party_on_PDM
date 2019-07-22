@extends('layouts.template')

@section('content')	
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style type="text/css">
    .padding-border-table{
        padding-left: 3%;
        padding-right: 3%;
      }
    @font-face {
        font-family: "font_gothamBook";
        src: url("fonts/GothamMedium.woff") format('woff');
        /*src: url("fonts/GothamBook.woff") format('woff');*/
        }
    .main-header .logo{
      font-family: font_gothamBook, sans-serif;
      font-display: swap;
      font-size: 20px;
    }
    body {
      font-family: font_gothamBook, sans-serif;
      font-size: 13px;
      font-display: swap;
    }
    .mm-left{
        margin-left: 2%;
      }
</style>
<style type="text/css">
	#header-title{
		padding-left: 10%;
		padding-top: 2%;
	}
	#header-text{
		padding-top: 2%
	}
	.left-8{
		padding-left: 8%;
	}
	.left-5{
		padding-left: 5%;
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
		padding: 5px;
	}

</style>
<div class="row">
	<div class="col-xs-12">
  	<div class="box"> 
  		<div class="box-header col-md-10 col-md-offset-1 ">
  			<div class="col-md-3">
  				<img src="/images/logos/logo-main-side-bar.png" style="width: 100%;">
  			</div>
  			<div class="col-md-6" id = "header-title">
  			  <h2>REPORTE DE ATENCION</h2> 
  			</div>
  			<div class="col-md-3 left-8" id = "header-text">
  				<span>Codigo: FOR-DD-001 <br>
								Version: 00<br>
								Vigencia: Jun 2018</span>
  			</div>  			
  		</div>
  		<div class="box-body ">
  				<table class="col-md-10 col-md-offset-1 bg-gray">
					  <tr>
					    <td><b> Reporte N°: </b> 001 – 2018 
						    <a href="/{{$url_pdf}}" target= "_blank"> 
									<i class="fa fa-file-pdf-o"></i>
					  		</a>
				  		</td>
					    <td><b>Fecha de Atencion:</b>{{$app->date_time}} <!--27 de setiembre de 2018--></td>
					  </tr>
					</table>
					
					<div class="space col-md-12">  </div>
					
					<table class="col-md-10 col-md-offset-1">
					  <tr class="bg-gray">
					    <td class="col-md-3 left-8"><b>ATENCION <br> LOCALIZADA </b></td>
					    <td class="col-md-3 left-8"><b>TRASLADO EN <br>AMBULANCIA</b></td>
					    <td class="col-md-3 left-8"><b>ATENCION EN <br>CONSULTORIO</b></td>
					    <td class="col-md-3" style="padding-left: 10%;"><b>OTROS</b></td>
					  </tr>
					  <tr>
						  <td></td>
						  <td></td>
						  <td style="padding-left: 12%"> <b> X </b></td>
						  <td></td>
					  </tr>
					</table>
					
					<div class="space col-md-12">  </div>
					
					<table class="col-md-10 col-md-offset-1">
					  <tr>
						  <td>TIPO DE</td>
						  <td><b>ATENCIÓN COMÚN</b></td>
						  <td class="col-md-1"></td>
						  <td><b>PROCEDIMIENTO DE ENFERMERÍA</b></td>
						  <td class="col-md-1" >  </td>
					  </tr>
					  <tr>
						  <td>ATENCIÓN</td>
						  <td><b>EMERGENCIA</b></td>
						  <td></td>
						  <td><b>LABORATORIO</b></td>
						  <td> - </td>
					  </tr>
					  <tr>
						  <td></td>
						  <td><b>URGENCIA</b></td>
						  <td> </td>
						  <td><b>CONSULTA A ESPECIALIDAD</b></td>
						  <td> </td>
					  </tr>
					</table>

					<div class="space col-md-12">  </div>	

					<table class="col-md-10 col-md-offset-1">
					  <tr>
							<td class="col-md-3" style="padding-left: 5%"> <b> LUGAR DE ATENCIÓN </b></td>
						  <td>  </td>
					  </tr>
					</table>					 

					<div class="space col-md-12">  </div>	

					<table class="col-md-10 col-md-offset-1">
					  <tr class="bg-gray">
					    <td><b>DATOS DE FILIACION </b></td>
					    <td><b> DEL PACIENTE</b></td>
					  </tr>
					  <tr>
					    <td class="col-md-3"><b>Nombres y Apellidos</b></td>
					    <td>  </td>
					  </tr>
					  <tr>
					    <td class="col-md-3"><b>Edad</b></td>
					    <td> </td>
					  </tr>
					  <tr>
					    <td class="col-md-3"><b>DNI / CE / PASAPORTE</b></td>
					    <td> </td>
					  </tr>
					  <tr>
					    <td class="col-md-3"><b>EPS / Aseguradora</b></td>
					    <td> </td>
					  </tr>
					  <tr>
					    <td class="col-md-3"><b>Código de Póliza</b></td>
					    <td> </td>
					  </tr>
					  <tr>
					    <td class="col-md-3"><b>Seguro (EsSalud/SIS)</b></td>
					    <td>  </td>
					  </tr>
					</table>

					<div class="space col-md-12">  </div>

					<table class="col-md-10 col-md-offset-1">
					  <tr class="bg-gray">
					    <td><b>PERSONAL </b></td>
					    <td><b> ASISTENTE </b></td>
					    <td><b>VEHICULO </b></td>
					    <td><b> ASISTENTE </b></td>
					  </tr>
					  <tr class="bg-gray">
					    <td class="col-md-2 left-5"><b>ASISTENTES</b></td>
					    <td class="col-md-3 left-5"><b>APELLIDOS Y NOMBRES</b></td>
					    <td class="col-md-2 left-5"><b>Nº. Placa</b></td>
					    <td class="col-md-3 left-5"><b>Nombre del conductor</b></td>
					  </tr>
					  <tr>
					  	<td><b>PS 01</b></td>
					  	<td>Dr. Richard Fernández Mata</td>
					  	<td></td>
					  	<td></td>
					  </tr>
					</table>  

					<div class="space col-md-12">  </div>

					<table class="col-md-10 col-md-offset-1">
					  <tr class="bg-gray">
							<td> <b> DESCRIPCION </b></td>
					  </tr>
					  <tr>
							<td> 
								<ul>
									<li>(Anamnesis)</li>
									<li>Diagnóstico: CIE-10</li>
									<li>Clasificación: (Colocar Tipo de Atención)</li>
									<li>Tratamiento:  (Instrucciones)</li>	
									<ul>
										<li> ( Grupo ) - (Nombre del medicamento)</li>	
										<li> antinflamatorios - naproxeno</li>	
									</ul>									
								</ul>
							</td>
					  </tr>
					</table>
					<div class="space col-md-12">  </div>
					<table  class="col-md-3 col-md-offset-7">
						<tr><td class="left-5"> <h2> FIRMA</h2></td></tr>
					</table>
					<div class="space col-md-12">  </div>
					<div class="col-md-10 col-md-offset-3"> Este documento una vez impreso se considera no controlado.  </div>
  		</div>	
  	</div>
  </div>
</div>

@endsection