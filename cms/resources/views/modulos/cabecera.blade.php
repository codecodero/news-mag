 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        @foreach ($admin as $element)
         @if ($element->email==$_COOKIE['email_login'])
          <a href="#" class="nav-link">Hola <b>{{ $element->name }}</b>, eres <b>{{($element->rol ==1) ? 'Administrador' : 'Editor'}}</b></a>
         @endif
         @break
        @endforeach
      </li>
    </ul> 
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">      
      @foreach ($admin as $user)
      @if ($user->email==$_COOKIE['email_login'])
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><img class="rounded-circle" width="30" src="{{($user->foto!=null) ? (url('/').'/'. $user->foto) : (url('/').'/'.'img/admin/default.png') }}"> <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" data-widget="control-sidebar" data-slide="true" role="button" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">          
            <i class="fas fa-sign-out-alt"></i>
            Salir
          </a>
          <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none" >
          @csrf       
          </form>
        </div>
      </li>
      @endif
      @endforeach
    </ul>
  </nav>
  <!-- /.navbar -->