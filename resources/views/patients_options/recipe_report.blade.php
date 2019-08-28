@extends('layouts.template')

@section('content')
<meta charset="utf-8">
<style type="text/css" media="all">
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
  
  .p-left{
    padding-left: 5%;
  }
  #header-title{
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
    padding: 5px;
    padding-left: 5%;
    padding-right: 5%;
  }
  .margin-right{
    padding-right: 100px;
  }
</style>

<div class="row">
<div class="col-md-12">
    <div class="box">
    	<div class="box-body p-left">
    		<div class="space col-md-12">  </div>

      <table class="col-md-10 col-md-offset-1">
        <tr >
	        <td ROWSPAN="2"><b> DocDoor </b> </td>
	        <td COLSPAN="2" class="bg-gray"><b>RECETA MÉDICA DE ATENCIÓN MÉDICA</b>
	        	<a href="/{{$url_pdf}}" target= "_blank"> <i class="fa fa-file-pdf-o"></i> </a>
	        </td>
	        <td>Código: FOR-DD-002</td>
        </tr>
        <tr>
          <td>Receta N°: AA-000{{$info['id']}}</td>
          <td>Fecha: {{$info['date']}}</td>
          <td>Vigencia: {{$info['vigencia']}}</td>
        </tr>
        <tr>
        	<td COLSPAN="2">Paciente: {{$info['patient-name']}}</td>
        	<td> DNI: {{$info['dni']}} </td>
        	<td> Próximo Control: {{$info['prox_attention']}}</td>
        </tr>
        <tr>
        	<td COLSPAN="2"> Dx: </td>
        	<td COLSPAN="2"> Alergias: </td>
        </tr>
        <tr>
        	<td COLSPAN="2"> <b>Rp.-</b> <br>
        		<ol>
        		@foreach ($info['medicines'] as $med)
              <li> {{$med}} </li> 
            @endforeach
            </ol>
        		Médico tratante:<br>
        		{{$info['doctor-name']}}<br>
        		CMP:<br>
        		Numero de CMP<br>
        	</td>
        	<td COLSPAN="2"> <b> Indicaciones: </b> <br>
        		<ol>
        		@foreach ($info['instructions'] as $in)
             <li> {{$in}}</li>
            @endforeach	
        		</ol>	        		
        	 </td>
        </tr>
      </table>
      	</div>
    </div>
</div>  
</div>
@endsection