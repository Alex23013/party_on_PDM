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
      <div class="box-header col-md-12 col-md-offset-1 ">
       <div class="col-md-3">
          <!--<img src="/images/logos/logo-main-side-bar.png" style="width: 100%;">-->
          <h3>DocDoor</h3>
        </div> 
        <div class="col-md-8" id = "header-title">
          <h3> Historia Clinica de la cita {{$info['attention_code']}}@if($info['pdf_status'] == 2 )
          <a href="/{{$url_pdf}}" target= "_blank"> <i class="fa fa-file-pdf-o"></i> </a>
          @endif
          </h3> 
        </div>
        <div class="col-md-3 left-8" id = "header-text">
          <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              @if($info['pdf_status'] == 0 )
              <a href="/patients/clinic_history/request/{{$info['id']}}"> <button class="btn  btn-flat bg-purple m-left">  <i class="fa fa-edit"></i> Solicitar permiso para exportar PDF </button> 
              </a>
              @endif
              @if($info['pdf_status'] == 1 )
              <button class="btn  btn-flat bg-purple m-left"> En espera del permiso para exportar PDF</button> 
              @endif
            </div>
            <div class="col-md-3"></div>
          </div> 
        </div>        
      </div>
      <div class="space col-md-12">  </div>
      <div class="box-body p-left">
      <table class="col-md-10 col-md-offset-1 margin-right">
        <tr class="bg-gray">
          <td COLSPAN="2"><b>DATOS DEL PACIENTE</b></td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Nombres:</b></td>
          <td> {{$info['patient-name']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b> Edad:</b></td>
          <td> {{$info['patient-age']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b> Género:</b></td>
          <td> {{$info['patient-genre']}} </td>
        </tr>        
      </table>
      <div class="space col-md-12">  </div>

      <table class="col-md-10 col-md-offset-1">
        <tr class="bg-gray">
          <td COLSPAN="2"><b>ANTECEDENTES</b></td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Personales: </b></td>
          <td>  
            @foreach ($info['personal_antecedents'] as $per)
              {{$per}}      <br>
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Familiares: </b></td>
          <td>  
            @foreach ($info['family_antecedents'] as $per)
              {{$per}}      <br>
            @endforeach
          </td>
        </tr>
      </table>

      <div class="space col-md-12">  </div>

      <table class="col-md-10 col-md-offset-1">
        <tr class="bg-gray">
          <td COLSPAN="2"><b>FUNCIONES VITALES</b></td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Peso:</b></td>
          <td> {{$info['weight']}} Kg</td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Talla:</b></td>
          <td> {{$info['height']}} m</td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Frecuencia Cardiaca:</b></td>
          <td> {{$info['cardiac_frequency']}} lpm</td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Frecuencia Respiratoria:</b></td>
          <td> {{$info['breathing_frequency']}} rpm</td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Presion Arterial: </b></td>
          <td> {{$info['arterial_pressure']}} mmHg</td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Saturación de Oxígeno: </b></td>
          <td> {{$info['sato']}} % </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Temperatura:</b></td>
          <td> {{$info['temperature']}} C° </td>
        </tr>
        
      </table> 

      <div class="space col-md-12">  </div>

      <table class="col-md-10 col-md-offset-1">
        <tr class="bg-gray">
          <td COLSPAN="2"><b>DATOS DE LA ATENCIÓN</b></td>
        </tr>
        <tr >
          <td class="col-md-3"><b>Doctor:</b></td>
          <td > {{$info['doctor_name']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Fecha:</b></td>
          <td> {{$info['date']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Hora:</b></td>
          <td> {{$info['time']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Motivo de la Consulta:</b></td>
          <td> {{$info['motive']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Anamnesis: </b></td>
          <td> {{$info['anamnesis']}} </td>
        </tr>
      </table>
      <div class="space col-md-12">  </div>

      <table class="col-md-10 col-md-offset-1">
        <tr class="bg-gray">
          <td COLSPAN="2"><b>EXÁMEN FÍSICO</b></td>
        </tr>
        
        <tr>
          <td> {{$info['sub_0']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_1']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_2']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_3']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_4']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_5']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_6']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_7']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_8']}} </td>
        </tr>
        <tr>
          <td> {{$info['sub_9']}} </td>
        </tr>
      </table>
      <div class="space col-md-12">  </div>

      <table class="col-md-10 col-md-offset-1">
        <tr class="bg-gray">
          <td COLSPAN="2"><b>OTROS DATOS DE LA HISTORIA</b></td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Exámenes auxiliares:</b></td>
          <td> {{$info['aux_exams']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Impresión Diagnóstica:</b></td>
          <td> {{$info['diagnosis_impresion']}} </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Tratamiento:</b></td>
          <td>  
            @foreach ($info['medicines'] as $med)
              {{$med}}      <br>
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="col-md-3"><b>Indicaciones:</b></td>
          <td>  
            @foreach ($info['instructions'] as $in)
              {{$in}}      <br>
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="col-md-3"><b> Próxima consulta:</b></td>
          <td> {{$info['prox_attention']}} </td>
        </tr>
      </table>
      <div class="space col-md-12">  </div>
          <div class="col-md-10 col-md-offset-3"> * Este documento una vez impreso se considera no controlado.  </div>       
          
      </div>
        <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection