<aside class="main-sidebar">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           
          <img src="{{$url_image}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          {{ Auth::user()->name_role}}
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

            <li class="treeview active">
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
              <i class="fa fa-calendar"></i> <span>Horarios</span>
            </a>
          </li>
          
          <li>
            <a href="/d_services">
              <i class="fa fa-suitcase"></i> <span>Solicitudes DocDoor</span>
            </a>
          </li>
          @endif
          @if( Auth::user()->role == 3)
          <li>
            <a href="#">
              <i class="fa fa-bell"></i> <span>Llamada de Emergencia</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-plus"></i> <span>Solicitud de cita</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-list"></i> <span>Lista de citas reservadas</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-suitcase"></i> <span>Historial de citas</span>
            </a>
          </li>
          @endif
        </ul>      
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
