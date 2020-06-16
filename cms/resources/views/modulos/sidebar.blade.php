 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{url('/')}}" class="brand-link">
      <img src="{{url('/')}}/vista/img/icono.jpg"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">News Mag</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{url('/')}}/vista/img/admin.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('/')}}/blog" class="nav-link">
              <i class="nav-icon fas fa-th-large"></i>
              <p>Blog</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/')}}/admin" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Administradores</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/')}}/categorias" class="nav-link">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>Categorias</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/')}}/articulos" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>Artículos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/')}}/comentarios" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>Comentarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/')}}/banner" class="nav-link">
              <i class="nav-icon fas fa-photo-video"></i>
              <p>Benners</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/')}}/ads" class="nav-link">
              <i class="nav-icon fas fa-ad"></i>
              <p>Ads</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{substr(url('/'),0,-11)}}" class="nav-link" target="_blank">
              <i class="nav-icon fas fa-globe"></i>
              <p>Sitio Web</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>