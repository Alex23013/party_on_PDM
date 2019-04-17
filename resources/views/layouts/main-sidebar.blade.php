<aside class="main-sidebar">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           
          <img src="/images/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          {{ Auth::user()->name_role}}
        </div>
      </div>
      
      <div>
        <ul class="sidebar-menu" data-widget="tree">
          @if( Auth::user()->role == 0)
            <li><a href="/users">
              <i class="glyphicon glyphicon-user"></i> <span>Miembros</span>
              </a></li>
            <li><a href="#">
              <i class="glyphicon glyphicon-plus"></i> <span>Añadir miembro</span>
              </a></li>
          @endif
        </ul>      
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
