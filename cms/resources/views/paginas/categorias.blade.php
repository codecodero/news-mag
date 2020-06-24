  @extends('plantilla')
  @section('contenido')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorias</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Categorias</li>
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
                <h3 class="card-title">Categorias del News Mag</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#nuevoCategoria">Crear categoria</button>                
              </div>
              <div class="card-body">
                <table id="tabla_categorias" class="table table-bordered table-hover dt-responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Categoria</th>
                      <th>Descripción</th>
                      <th>Palabras Claves</th>
                      <th>URL</th>
                      <th>Imagen</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
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
  {{-- FIXME: Modal Crear Categoria --}}
<div class="modal fade" id="nuevoCategoria" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="{{url('/')}}/categorias" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Categoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
              <div class="col-md-6">
                <input id="categoria" type="text" class="form-control" name="categoria"
                  value="" required autocomplete="categoria" autofocus>
                @error('categoria')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
              <div class="col-md-6">
                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                  value="" required autocomplete="descripcion">
                @error('descripcion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="ruta"
                class="col-md-4 col-form-label text-md-right">{{ __('Ruta') }}</label>
              <div class="col-md-6">
                <input id="ruta" type="text" class="form-control ruta" name="ruta" required
                  autocomplete="ruta">
              </div>
            </div>
            <div class="form-group row">
              <label for="palabras_claves" class="col-md-4 col-form-label text-md-right">{{ __('Palabras Claves') }}</label>

              <div class="col-md-6">
                <input id="palabras_claves" type="text" class="form-control"
                  name="palabras_claves" required autocomplete="palabras_claves" data-role="tagsinput">

                @error('palabras_claves')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="small">separados por coma (,)</span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">{{ __('Subir Imagen') }}</label>
              <div class="col-md-6">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="foto" name="foto" required>
                  <label class="custom-file-label" for="imagen">Selecionar imagen</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>
              <div class="col-md-6">
                <img class="img-fluid img_foto"
                  src="{{ url('/') }}/img/categorias/default.png"
                  alt="">              
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

@if (isset($status))
  @if ($status==200)
    {{-- FIXME: Modal Editar Categoria --}}
  <div class="modal fade" id="editarCategoria" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="{{url('/')}}/categorias/{{$categoria[0]['id']}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar Categoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="categoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
              <div class="col-md-6">
                <input id="categoria" type="text" class="form-control" name="categoria"
                  value="{{$categoria[0]['categoria']}}" required autocomplete="categoria" autofocus>
                @error('categoria')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
              <div class="col-md-6">
                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                  value="{{$categoria[0]['descripcion']}}" required autocomplete="descripcion">
                @error('descripcion')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="ruta"
                class="col-md-4 col-form-label text-md-right">{{ __('Ruta') }}</label>
              <div class="col-md-6">
                <input id="ruta" type="text" class="form-control ruta" name="ruta" required
                  autocomplete="ruta" value="{{$categoria[0]['ruta']}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="palabras_claves" class="col-md-4 col-form-label text-md-right">{{ __('Palabras Claves') }}</label>

              <div class="col-md-6">
                @php
                  $tags=json_decode($categoria[0]['palabras_claves'],true);
                  $palabras_claves="";
                  foreach ($tags as $tg => $tag) {
                    $palabras_claves.=$tag.",";
                  }
                @endphp
                <input id="palabras_claves" type="palabras_claves" class="form-control @error('palabras_claves') is-invalid @enderror"
                  name="palabras_claves" required autocomplete="palabras_claves" data-role="tagsinput" value="{{$palabras_claves}}">

                @error('palabras_claves')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="small">separados por coma (,)</span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">{{ __('Subir Imagen') }}</label>
              <div class="col-md-6">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="foto" name="foto">
                  <label class="custom-file-label" for="imagen">Selecionar imagen</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>
              <div class="col-md-6">
                <input type="hidden" name="img_actual" value="{{$categoria[0]['img']}}">
                <img class="img-fluid img_foto"
                  src="{{ url('/').'/'. $categoria[0]['img']}}"
                  alt="">              
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
  <script type="text/javascript">
    $("#editarCategoria").modal();
  </script> 
  @else
  <script>
  notie.alert({
  type:3,
  text:'No existe la Categoria',
  time:7
  });
</script>
  @endif

@endif

@if (Session::has("success-update"))
  <script>
  notie.alert({
  type:1,
  text:'Categoria actualizado correctamente',
  time:7
  });
</script>
@endif

@if (Session::has("serror-update-cat"))
  <script>
  notie.alert({
  type:3,
  text:'Error en actualizar la Categoria',
  time:7
  });
</script>
@endif

@if (Session::has("vacio-update"))
  <script>
  notie.alert({
  type:2,
  text:'Error ingrese todos los campos',
  time:7
  });
</script>

@endif

@if (Session::has("error_eliminar_cat"))
  <script>
  notie.alert({
  type:3,
  text:'Error al eliminar la Categoria',
  time:7
  });
</script>
@endif


@if (Session::has("categoria-img"))
  <script>
  notie.alert({
  type:2,
  text:'Debe seleccionar una Imagen Max. 2MB',
  time:7
  });
</script>
@endif

@if (Session::has("categoria-error"))
  <script>
  notie.alert({
  type:2,
  text:'Debe ingresar datos validos de la categoria',
  time:7
  });
</script>
@endif

@if (Session::has("success-categoria"))
  <script>
  notie.alert({
  type:1,
  text:'Categoria registrado correctamente',
  time:7
  });
</script>
@endif

@if (Session::has("error-categoria"))
  <script>
  notie.alert({
  type:3,
  text:'Error al registrar categoria',
  time:7
  });
</script>
@endif

@endsection