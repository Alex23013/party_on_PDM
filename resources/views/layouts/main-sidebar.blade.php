<aside class="main-sidebar">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           <img src="/images/logos/icon DocDoor-01.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <div class="col-md-12">
            <img src="/images/logos/logoDD.png" style="width: 100%;">  
          </div>
          <!--<span><b> DocDoor </b></span>-->
        </div>
      </div>
      
      <div>
        <ul class="sidebar-menu" data-widget="tree">
          <!--menu Administrador-->
          @if( Auth::user()->role == 0)  
          <li><a href="/techs">
              <i class="glyphicon glyphicon-user"></i> <span>Técnicos</span>
            </a>
          </li>

          <li>
            <a href="/partners">
              <i class="fa fa-users"></i> <span>Asociados</span>
            </a>
          </li>
          <li>
            <a href="/d_services">
              <i class="fa fa-suitcase"></i> <span>Solicitudes DocDoor</span>
            </a>
          </li>

          <li><a href="/users">
              <i class="glyphicon glyphicon-user"></i> <span>Miembros</span>
              </a>
          </li>

           <li>
            <a href="#">
              <i class="fa fa-hospital-o"></i> <span> Historias clínicas </span>
            </a>
          </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-plus"></i> <span>Añadir miembro</span> <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
              <li><a href="/users/add/1"><i class="fa fa-circle-o"></i> Doctor</a></li>
              <li><a href="/users/add/2"><i class="fa fa-circle-o"></i> Triaje </a></li>
              <li><a href="/users/add/0"><i class="fa fa-circle-o"></i> Administrador</a></li>
            </li>            
           
          @endif
          <!--menu triaje-->
          @if( Auth::user()->role == 2)
          <li>
            <a href="/">
               <span>MENU PRINCIPAL</span>
            </a>
          </li>
          <li>
            <a href="/techs">
              <i class="glyphicon glyphicon-user"></i> <span>Técnicos</span>
            </a>
          </li>
          <li>
            <a href="/partners">
              <i class="fa fa-users"></i> <span>Asociados</span>
            </a>
          </li>
          <li>
            <a href="/patients">
              <i class="glyphicon glyphicon-user"></i> <span>Pacientes</span>
            </a>
          </li>
          <li>
            <a href="/doctors/schedule">
              <i class="fa fa-calendar"></i> <span>Horarios de médicos</span>
            </a>
          </li>
          
          <li>
            <a href="/d_services">
              <i class="fa fa-suitcase"></i> <span>Solicitudes DocDoor</span>
            </a>
          </li>
          <li>
            <a href="/appointments">
              <i class="fa fa-stethoscope"></i> <span>Citas médicas</span>
            </a>
          </li>
          <li>
            <a href="/emergency">
              <i class="fa fa-ambulance"></i> <b><span>Emergencias</span></b>
            </a>
          </li>
          
          @endif
          <!--menu paciente-->
          @if( Auth::user()->role == 3)
          <li>
            <a href="/patients/new_inbox_emergency">
              <i class="fa fa-ambulance"></i> <span>Llamada de Emergencia</span>
            </a>
          </li>
          <li>
            <a href="/patients/new_inbox_appointment">
              <i class="fa fa-plus"></i> <span>Solicitud de cita</span>
            </a>
          </li>
          <li>
            <a href="/patients/services">
              <i class="fa fa-suitcase"></i> <span>Servicios DocDoor</span>
            </a>
          </li>
          <li>
            <a href="/patients/appointments/0">
              <i class="fa fa-eye"></i> <span>Lista de citas por confirmar</span>
            </a>
          </li>
          <li>
            <a href="/patients/appointments/1">
              <i class="fa fa-list"></i> <span>Lista de citas confirmadas</span>
            </a>
          </li>
          <li>
            <a href="/patients/history_appointments">
              <i class="fa fa-stethoscope"></i> <span>Historial de citas</span>
            </a>
          </li>
          @endif
        </ul>      
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
