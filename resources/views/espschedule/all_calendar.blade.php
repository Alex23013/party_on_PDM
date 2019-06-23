@extends('layouts.template')


@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
            <div class="box-header mm-left ">
            <h2>Horarios de Doctores Especialistas</h2>
            <br>
            <a href="/edoctors/schedule/add">  
                <button type="button" class="btn  bg-olive margin">
                 <h5 ><i class="fa fa-calendar-plus-o"></i> Agregar un horario</h5>
                </button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">  
            <div class="row mm-left">
              <div class="col-md-6">
                <label>Seleccione para ver los horarios por especialidad:</label>            
              
                <form class="form-horizontal " role="form" method="POST" action="">
                {{ csrf_field() }}
                <div class="form-group col-md-8">
                    <select class="form-control" name = "userId" >
                    <option value=""> Ver todos</option>
                    </select>   
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-info">Buscar</button>
                </div>
                </form>
                </div>
                <div class="col-md-6">
                  <label>Seleccione para ver los horarios por doctor:</label>
                  <form class="form-horizontal " role="form" method="POST" action="">
                    {{ csrf_field() }}
                    <div class="form-group col-md-8">
                        <select class="form-control" name = "userId" >
                        <option value=""> Ver todos</option>
                        </select>   
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-info">Buscar</button>
                    </div>
                  </form>
                </div>
            </div>
              <div id="calendar" class="padding-border-table"></div>
            </div>
            <!-- /.box-body -->
    </div>
  </div>
</div>

      
	
@endsection


@section('specific scripts')
<!--CALENDAR Page specific script -->
<script type="text/javascript" >
  $(function () {
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week : 'semana',
        day  : 'dia'
      },     
      events    : <?php echo json_encode($jsonevents)?>,
    })  
  })
</script> 

@endsection