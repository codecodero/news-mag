@extends('plantilla')
@section('contenido')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administradores</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Administradores</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Administradores del Portal</h3>
              <button id="" data-toggle="modal" data-target="#nuevoAdmin" class="btn btn-primary float-right">Crear
                nuevo</button>
            </div>
            <div class="card-body">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Foto</th>
                      <th>Rol</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($admins as $items=>$item)
                    <tr>
                      <td>{{$item['id']}}</td>
                      <td>{{$item['name']}}</td>
                      <td>{{$item['email']}}</td>
                      <td><img width="40px" class="rounded-circle"
                          src="{{isset($item['foto']) ? $blog[0]['cms'].'/'.$item['foto'] : $blog[0]['cms'].'img/admin/default.png'}}">
                      </td>
                      <td>{{$item['rol']==1?'Administrador':'Editor'}}</td>
                      <td><a href="{{url('/')}}/admin/{{$item['id']}}" class="fas fa-edit btn btn-outline-info"></a> |
                        <span class="fas fa-trash btn btn-outline-danger"></span></td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              &nbsp;
            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="nuevoAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo Administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
            <div class="col-md-6">
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="password-confirm"
              class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

            <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary float-left">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</div>

@if(isset($status))
@if ($status==200)
@foreach ($admins as $item)
<div class="modal fade" id="editarAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{url('/')}}/admin/{{$item['id']}}" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar Administrador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
            <div class="col-md-6">
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ $item['name'] }}" required autocomplete="name" autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

            <div class="col-md-6">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ $item['email'] }}" required autocomplete="email">

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" autocomplete="new-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <input type="hidden" name="contrasena_actual" value="{{ $item['password'] }}">
          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
            <div class="col-md-6">
              <select class="form-control" name="rol" id="rol">
                <option value="0">--Seleccionar--</option>
                <option {{ $item['rol']==1 ? 'selected' : ''}} value="1">Administrador</option>
                <option {{ $item['rol']==2 ? 'selected' : ''}} value="2">Editor</option>
              </select>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('Subir foto') }}</label>
            <div class="col-md-6">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="foto" name="foto">
                <label class="custom-file-label" for="foto">Selecionar foto</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>
            <div class="col-md-6">
              <img width="60px" class="rounded-circle"
                src="{{isset($item['foto']) ? $blog[0]['cms'].'/'.$item['foto'] : $blog[0]['cms'].'img/admin/default.png'}}"
                alt="">
              <input type="hidden" name="foto_actual"
                value="{{isset($item['foto']) ? $item['foto'] : 'img/admin/default.png'}}">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary float-left">Actualizar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach
<script>
  $("#editarAdmin").modal();
</script>
@else
{{$status}}
@endif
@endif

@if (Session::has('password-invalido'))
<script>
  notie.alert({
type:2,
text:'Contraseña invalida, Min. 8 Caract.',
time:7
});
</script>
@endif

@if (Session::has('img-invalido'))
<script>
  notie.alert({
type:2,
text:'Imagen no valido Max. 2MB',
time:7
});
</script>
@endif

@if (Session::has('datos-invalidos'))
<script>
  notie.alert({
type:2,
text:'Ingrese datos validos',
time:7
});
</script>
@endif

@if (Session::has('datos-vacios'))
<script>
  notie.alert({
type:2,
text:'Campos vacios, ingrese datos validos',
time:7
});
</script>
@endif

@if (Session::has('error'))
<script>
  notie.alert({
type:3,
text:'Error en actualizar datos',
time:7
});
</script>
@endif

@if (Session::has('success'))
<script>
  notie.alert({
type:1,
text:'Actualizado correctamente',
time:7
});
</script>
@endif

@endsection