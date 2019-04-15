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
            <li><a href="#">
              <i class="glyphicon glyphicon-plus"></i> <span>Añadir miembro</span>
              </a></li>
            <li><a href="#">
              <i class="glyphicon glyphicon-user"></i> <span>Miembros</span>
              </a></li>
            <li><a href="#">
              <i class="fa fa-calendar"></i> <span>Calendario general</span>
              </a></li>
             <li><a href="#">
              <i class="fa fa-group "></i> <span>Grupos</span>
              </a></li> 
        </ul>      
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
