<div class="login-box">
<div class="login-logo">
  <a href="#"><b>News Mag</b></a>
</div>
<!-- /.login-logo -->
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">Inicia Sesión</p>

    <form action="{{ route('login') }}" method="post">
      @csrf
      <div class="input-group mb-3">
        <input id="email" type="email" name="email" class="form-control email_login @error('email') is-invalid @enderror" placeholder="Correo Electrónico" value="{{ old('email') }}" required autocomplete="email" autofocus>        
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">       
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
         @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="ml-3 input-group-append">
        <div class="col-md-12">
          <div class="icheck-primary">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">
              Recuérdame
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </div>
      </div>
    </form>

    <div class="social-auth-links text-center mb-3">
      <p>- O -</p>
      <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i> Inicia sesión con Facebook
      </a>
      <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google mr-2"></i> Inicia sesión con Google
      </a>
    </div>
    <!-- /.social-auth-links -->

    @if (Route::has('password.request'))
    <p class="mb-1 text-center">
      <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
    </p>
    @endif
    @if (Route::has('register'))
    <p class="mb-0 text-center">
      <a href="{{ route('register') }}" class="text-center">Registrarse en News Mag</a>
    </p>
    @endif
  </div>
  <!-- /.login-card-body -->
</div>
</div>
