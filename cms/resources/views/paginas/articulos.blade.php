  @extends('plantilla')
  @section('contenido')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Artículos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Artículos</li>
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
                <h3 class="card-title">Artículos</h3>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#nuevoArticulo">Crear artículo</button>              
              </div>
              <div class="card-body">
                <table id="tabla_articulos" class="table table-bordered table-hover dt-responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Titúlo</th>
                      <th>Descripción</th>
                      <th>Categoria</th>
                      <th>Palabras Claves</th>
                      <th>Ruta</th>
                      <th width="300">Contenido</th>
                      <th>Portada</th>
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
  {{-- FIXME: Modal Crear Articulo --}}
<div class="modal fade" id="nuevoArticulo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form method="POST" action="{{url('/')}}/articulos" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Artículo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="categorias" class="col-md-3 col-form-label text-md-right">{{ __('Categorias') }}</label>
              <div class="col-md-9">
                <select id="categoria" class="form-control" name="categoria">
                  <option value="0">--Selecionar--</option>
                  @foreach ($categorias as $element)
                  <option value="{{$element['id']}}">{{$element['categoria']}}</option>                    
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="Titúlo" class="col-md-3 col-form-label text-md-right">{{ __('Titúlo') }}</label>
              <div class="col-md-9">
                <input id="titulo" type="text" class="form-control" name="titulo"
                  value="" required >
              </div>
            </div>
            <div class="form-group row">
              <label for="descripcion"
                class="col-md-3 col-form-label text-md-right">{{ __('Descripción corta') }}</label>
              <div class="col-md-9">
                <input id="descripcion" type="text" class="form-control" name="descripcion" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="ruta"
                class="col-md-3 col-form-label text-md-right">{{ __('URL del artículo') }}</label>
              <div class="col-md-9">
                <input id="ruta" type="text" class="form-control ruta" name="ruta" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="palabras_claves" class="col-md-3 col-form-label text-md-right">{{ __('Palabras Claves') }}</label>
              <div class="col-md-9">
                <input id="palabras_claves" type="text" class="form-control"
                  name="palabras_claves" required data-role="tagsinput">
                <span class="small">Separados por coma (,)</span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">{{ __('Subir Imagen') }}</label>
              <div class="col-md-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="foto" name="foto" required>
                  <label class="custom-file-label" for="foto">Selecionar imagen</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">{{ __('Imagen') }}</label>
              <div class="col-md-9">
                <img class="img-thumbnail img_foto" width="500" 
                  src="{{ url('/') }}/img/articulos/default.png"
                  alt="">              
              </div>
            </div>
             <div class="form-group row">
              <label for="contenido" class="col-md-12 col-form-label text-md-right">{{ __('Contenido') }}</label>
              <div class="col-md-12">
                <textarea class="form-control summernote" name="contenido" placeholder="Contenido del artículo"></textarea>
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
      {{-- FIXME: Modal Editar Articulo --}}
<div class="modal fade" id="editarArticulo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form method="POST" action="{{url('/')}}/articulos/{{$articulo[0]['id']}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar Artículo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="categorias" class="col-md-3 col-form-label text-md-right">{{ __('Categorias') }}</label>
              <div class="col-md-9">
                <select id="categoria" class="form-control" name="categoria">
                  <option value="0">--Selecionar--</option>
                  @foreach ($categorias as $element)
                  <option value="{{$element['id']}}" {{($element['id']==$articulo[0]['id_categoria']) ? 'selected' : ''}} >{{$element['categoria']}}</option>                    
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="Titúlo" class="col-md-3 col-form-label text-md-right">{{ __('Titúlo') }}</label>
              <div class="col-md-9">
                <input id="titulo" type="text" class="form-control" name="titulo"
                  value="{{$articulo[0]['titulo']}}" required >
              </div>
            </div>
            <div class="form-group row">
              <label for="descripcion"
                class="col-md-3 col-form-label text-md-right">{{ __('Descripción corta') }}</label>
              <div class="col-md-9">
                <input id="descripcion" type="text" class="form-control" name="descripcion" required value="{{$articulo[0]['descripcion']}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="ruta"
                class="col-md-3 col-form-label text-md-right">{{ __('URL del artículo') }}</label>
              <div class="col-md-9">
                <input id="ruta" type="text" class="form-control ruta" name="ruta" readonly value="{{$articulo[0]['ruta']}}">
              </div>
            </div>
            <div class="form-group row">
              <label for="palabras_claves" class="col-md-3 col-form-label text-md-right">{{ __('Palabras Claves') }}</label>
              <div class="col-md-9">
               @php
                 $tags=json_decode($articulo[0]['palabras_claves'],true);
                 $palabras_claves=""; 
                 foreach ($tags as $tgs => $tg) {
                   $palabras_claves.=$tg.',';
                 }
               @endphp
                <input id="palabras_claves" type="text" class="form-control"
                  name="palabras_claves" required data-role="tagsinput" value="{{$palabras_claves}}">
                <span class="small">Separados por coma (,)</span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">{{ __('Subir Imagen') }}</label>
              <div class="col-md-9">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="foto" name="foto">
                  <label class="custom-file-label" for="foto">Selecionar imagen</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-3 col-form-label text-md-right">{{ __('Imagen') }}</label>
              <div class="col-md-9">
                <input type="hidden" name="img_actual" value="{{$articulo[0]['img']}}">
                <img class="img-thumbnail img_foto" width="500" 
                  src="{{ url('/').'/'.$articulo[0]['img']}}"
                  alt="">              
              </div>
            </div>
             <div class="form-group row">
              <label for="contenido" class="col-md-12 col-form-label text-md-right">{{ __('Contenido') }}</label>
              <div class="col-md-12">
                <textarea class="form-control summernote" name="contenido" placeholder="Contenido del artículo">{{$articulo[0]['contenido']}}</textarea>
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
  $("#editarArticulo").modal();
</script>

  @else
  <script type="text/javascript">
    notie.alert({
  type:3,
  text:'El artículo que busca no existe',
  time:7
  });
  </script>
  @endif

@endif


@if (Session::has('img-no-valido'))
  <script type="text/javascript">
    notie.alert({
  type:2,
  text:'Archivo selecionado no es una Imagen',
  time:7
  });
  </script>
@endif

@if (Session::has("img-vacio"))
   <script type="text/javascript">
    notie.alert({
  type:2,
  text:'Seleccione una imagen Max: 2MB',
  time:7
  });
  </script>
@endif

@if (Session::has('error-datos'))
   <script type="text/javascript">
    notie.alert({
  type:2,
  text:'Ingrese datos validos para crear un artículo',
  time:7
  });
  </script>
@endif

@if (Session::has("datos-vacios"))
  <script type="text/javascript">
    notie.alert({
  type:2,
  text:'Ingrese todos los campos del artículo',
  time:7
  });
  </script>
@endif

@if (Session::has("save-success"))
  <script type="text/javascript">
    notie.alert({
  type:1,
  text:'Artículo guardado con exíto',
  time:7
  });
  </script>
@endif
@if (Session::has("error-save"))
  <script type="text/javascript">
    notie.alert({
  type:3,
  text:'Error al crear un artículo',
  time:7
  });
  </script>
@endif

  @endsection