 <header class="main-header">
    <!-- Logo -->
    <div class="logo">
      
      <span class="logo-mini"><b>Doc</b>D</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Doc</b>Door</span>

    </div>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
     <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <span class="sr-only">Toggle navigation</span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/images/user.png" class="img-circle" alt="User Image" width="20" height="20">
              <span class="hidden-xs"><b>{{ Auth::user()->name }}</b> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                 <img src="/images/user.png" class="img-circle" alt="User Image">
                <p>
                  <b>{{ Auth::user()->name }}</b> 
                  <small>{{ Auth::user()->name_role }} </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
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