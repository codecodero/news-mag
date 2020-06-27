  @extends('plantilla')
  @section('contenido')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Ads</li>
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
                <h3 class="card-title">Administrar Ads</h3>
                <button class="btn btn-primary float-right" type="button" data-target="#nuevoAds" data-toggle="modal">Agregar Ads</button>                
              </div>
              <div class="card-body">
                <table id="tabla_ads" class="table table-bordered table-hover dt-responsive">
                  <thead>
                    <th>#</th>
                    <th>Página</th>
                    <th>Anuncio</th>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  {{-- TODO: nuevo Ads--}}
{{-- Modal --}}
<div class="modal fade" id="nuevoAds" tabindex="-1" role="dialog" aria-labelledby="NuevoModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="{{ url('/') }}/ads" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="NuevoModal">Agregando Ads</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" required>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="pagina_ads" class="col-sm-2 col-form-label">Página de Ads</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="pagina_ads" name="pagina_ads" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="codigo_ads" class="col-sm-2 col-form-label">Codigo de Ads</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="codigo_ads" rows="5" name="codigo_ads" required></textarea>
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
<div class="modal fade" id="editarAds" tabindex="-1" role="dialog" aria-labelledby="NuevoMOdal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="{{ url('/') }}/ads/{{$ads['id_ads']}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="NuevoMOdal">Editando Ads</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <div class="form-group row">
          <label for="pagina_ads" class="col-sm-2 col-form-label">Página de Ads</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="pagina_ads" name="pagina_ads" required value="{{$ads['pagina_anuncio']}}">
          </div>
        </div>
        <div class="form-group row">
          <label for="codigo_ads" class="col-sm-2 col-form-label">Codigo de Ads</label>
          <div class="col-sm-10">
            <textarea class="form-control" id="codigo_ads" rows="5" name="codigo_ads" required>{{$ads['codigo_anuncio']}}</textarea>
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
  $("#editarAds").modal();
</script>
@else
<script type="text/javascript">
    notie.alert({
  type:2,
  text:'El Ads que buscas no existe',
  time:7
  });
  </script>
  @endif
@endif
@if (Session::has("save_success"))
<script type="text/javascript">
    notie.alert({
  type:1,
  text:'Ads guardado correctamente',
  time:7
  });
  </script>
@endif

@if (Session::has("save_error"))
<script type="text/javascript">
    notie.alert({
  type:3,
  text:'Error al guardar Ads',
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

@if (Session::has('delete_error'))
  <script type="text/javascript">
    notie.alert({
  type:2,
  text:'El Ads que intentas eliminar no existe',
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