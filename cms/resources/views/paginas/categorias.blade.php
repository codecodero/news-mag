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
    <form method="POST" action="{{url('/')}}/categorias/store">
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
              class="col-md-4 col-form-label text-md-right">{{ __('URL Autogenerado') }}</label>

            <div class="col-md-6">
              <input id="ruta" type="text" class="form-control" name="ruta" required
                autocomplete="ruta">
            </div>
          </div>
          <div class="form-group row">
            <label for="palabras_claves" class="col-md-4 col-form-label text-md-right">{{ __('Palabras Claves') }}</label>

            <div class="col-md-6">
              <input id="palabras_claves" type="palabras_claves" class="form-control @error('palabras_claves') is-invalid @enderror"
                name="palabras_claves" required autocomplete="palabras_claves">

              @error('palabras_claves')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">{{ __('Subir Imagen') }}</label>
            <div class="col-md-6">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="foto" name="imagen" required>
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
  @endsection