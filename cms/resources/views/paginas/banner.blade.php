  @extends('plantilla')
  @section('contenido')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Banner</li>
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
                <h3 class="card-title">Banners del portal</h3>  
                <button class="btn btn-primary float-right" type="button" data-target="#nuevoBanner" data-toggle="modal">Agregar Banner</button>              
              </div>
              <div class="card-body">
                <table id="tabla_banner" class="table table-bordered table-hover dt-responsive">
                  <thead>
                    <th>#</th>
                    <th>Titúlo</th>
                    <th>Descripción</th>
                    <th>Banner</th>
                    <th>Página</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
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
    {{-- /.content --}}
  </div>
 {{-- .content-wrapper  --}}
    {{-- TODO: nuevo banner--}}
{{-- Modal --}}
<div class="modal fade" id="nuevoBanner" tabindex="-1" role="dialog" aria-labelledby="NuevoMOdal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="{{ url('/') }}/banner" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="NuevoMOdal">Agregando Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" required>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="TituloBanner" class="col-sm-2 col-form-label">Titúlo Banner</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="TituloBanner" name="titulo" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Descripción Banner</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="descripcion" rows="5" name="descripcion" required></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="pagina" class="col-sm-2 col-form-label">Página</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="pagina" name="pagina">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">{{ __('Subir Imagen') }}</label>
          <div class="col-md-10">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto" required>
              <label class="custom-file-label" for="foto">Selecionar imagen</label>
            </div>
          </div>
        </div>
        <div class="form-group row">          
          <div class="col-md-12">
            <img class="img-fluid img_foto"
              src="{{ url('/') }}/img/banners/default.jpg"
              alt="">              
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>

@if (isset($status))
  @if ($status==200)
    {{-- TODO: Editar banner--}}
<!-- Modal -->
<div class="modal fade" id="EditarBanner" tabindex="-1" role="dialog" aria-labelledby="NuevoMOdal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="{{ url('/') }}/banner/{{$banner['id_banner']}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="NuevoMOdal">Editando Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <div class="form-group row">
          <label for="TituloBanner" class="col-sm-2 col-form-label">Titúlo Banner</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="TituloBanner" name="titulo" value="{{$banner['titulo_banner']}}" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Descripción Banner</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="descripcion" rows="5" name="descripcion" required>{{$banner['descripcion_banner']}}</textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="pagina" class="col-sm-2 col-form-label">Página</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="pagina" name="pagina" value="{{$banner['pagina_banner']}}" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">{{ __('Subir Imagen') }}</label>
          <div class="col-md-10">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="foto" name="foto">
              <label class="custom-file-label" for="foto">Selecionar imagen</label>
            </div>
          </div>
        </div>
        <div class="form-group row">          
          <div class="col-md-12">
            <input type="hidden" name="img_actual" value="{{$banner['img_banner']}}">
            <img class="img-fluid img_foto" src="{{ url('/') }}/{{$banner['img_banner']}}" alt="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>
    </div>
  </div>

</div>
<script type="text/javascript">
  $("#EditarBanner").modal();
</script>
@else
<script type="text/javascript">
    notie.alert({
  type:2,
  text:'El banner que buscas no existe',
  time:7
  });
  </script>
  @endif
@endif

@if (Session::has("save_success"))
<script type="text/javascript">
    notie.alert({
  type:1,
  text:'Banner guardado correctamente',
  time:7
  });
  </script>
@endif

@if (Session::has("save_error"))
<script type="text/javascript">
    notie.alert({
  type:3,
  text:'Error al guardar Banner',
  time:7
  });
  </script>
@endif

@if (Session::has("datos_vacio"))
<script type="text/javascript">
    notie.alert({
  type:2,
  text:'Error datos vacios',
  time:7
  });
  </script>
@endif

@if (Session::has("img_vacio"))
<script type="text/javascript">
    notie.alert({
  type:2,
  text:'Error seleccione una imagen',
  time:7
  });
  </script>
@endif

@if (Session::has("img_error"))
<script type="text/javascript">
    notie.alert({
  type:2,
  text:'Error la imagen no es valido Max. 2MB',
  time:7
  });
  </script>
@endif
@if (Session::has('delete_error'))
  <script type="text/javascript">
    notie.alert({
  type:2,
  text:'El banner que intentas eliminar no existe',
  time:7
  });
  </script>
@endif
@if (Session::has('datos_error'))
  <script type="text/javascript">
    notie.alert({
  type:2,
  text:'Datos no validos',
  time:7
  });
  </script>
@endif

  @endsection