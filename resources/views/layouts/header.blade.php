 <header class="main-header">
    <!-- Logo -->
    <div class="logo">
      
      <span class="logo-mini">{{ Auth::user()->name_role[0]}}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ Auth::user()->name_role}}</span>

    </div>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
     <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <span class="sr-only">Toggle navigation</span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @if(Auth::user()->role == 2)
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id = "numNotify">{{$notify_calls}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tiene <span id = "numNot">{{$notify_calls}}</span> solicitudes sin atender</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="/">
                      <i class="fa fa-stethoscope text-aqua"></i> <span id = "numCites">{{$cites}}</span> solicitudes de citas médicas
                    </a>
                  </li> 
                  <li>
                    <a href="/">
                      <i class="fa fa-ambulance text-red"></i> <span id = "numEmergencies">{{$emergencies}}</span> solicitudes de emergencias
                    </a>
                  </li>               
                </ul>
              </li>
              <li class="footer"><a href="/">Ver todas</a></li>
            </ul>
          </li>
          @endif
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{$url_image}}" class="img-circle" alt="User Image" width="20" height="20">
              <span class="hidden-xs"><b>{{ Auth::user()->name }}</b> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                 <img src="{{$url_image}}" class="img-circle" alt="User Image">
                <p>
                  <b>{{ Auth::user()->name }}</b> 
                  <small>{{ Auth::user()->name_role }} </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                    <a href="/profile" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                <div class="pull-right">
                  <a href="/logout" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>