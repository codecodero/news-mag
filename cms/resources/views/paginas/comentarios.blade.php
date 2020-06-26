  @extends('plantilla')
  @section('contenido')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Comentarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Comentarios</li>
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
                <h3 class="card-title">Comentarios</h3>                
              </div>
              <div class="card-body">
               <table id="tabla_comentarios" class="table table-bordered table-hover dt-responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Artículo</th>
                      <th>Autor</th>
                      <th>Correo</th>
                      <th >Foto</th>
                      <th>Comentario</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                      <th>Respuesta</th>
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
@if (isset($status))
  @if ($status==200)
    {{-- TODO: editar comentario--}}
<!-- Modal -->
<div class="modal fade" id="modalComenterio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="{{ url('/') }}/comentarios/{{$comentario->id_comentario}}">
        @method('PUT')
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editando comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <h3>{{$comentario->titulo}}</h3>
          <div class="media">
            <div class="media-left">
              <img src="{{($comentario->img_usuario!=null)?url('/').'/'.$comentario->img_usuario:url('/').'/img/admin/default.png'}}" class="media-object rounded-circle" style="width:45px">
            </div>
            <div class="media-body ml-2">
              <h4 class="media-heading">{{$comentario->nombre_usuario}}<small>, <span class="font-weight-lighter">{{$comentario->correo_usuario}}</span>, <i class="text-muted">{{$comentario->fecha}}</i></small></h4>
              <p>{{$comentario->comentario}}</p>
              @if ($comentario->respuesta_comentario!=null)                
              <div class="media">
                <div class="media-left">
                  <img src="{{($comentario->foto!=null)?url('/').'/'.$comentario->foto:url('/').'/img/admin/default.png'}}" class="media-object rounded-circle" style="width:45px">
                </div>
                <div class="media-body ml-2">
                  <h4 class="media-heading">{{$comentario->name}} <small>, <span class="font-weight-lighter">{{$comentario->email}}</span>, <i class="text-muted">{{$comentario->fecha_respuesta}}</i></small></h4>
                  <p>{{$comentario->respuesta_comentario}}</p>
                </div>
              </div>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2 col-form-label">Estado</label>
            <div class="col-md-10">
              <div class="form-group">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="aprovado" value="1" name="estado" {{($comentario->estado==1)?'checked':''}}>
                  <label for="aprovado" class="custom-control-label text-primary">Aprovado</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="pendiente" value="0" name="estado" {{($comentario->estado==0)?'checked':''}}>
                  <label for="pendiente" class="custom-control-label text-warning">Pendiente</label>
                </div>
              </div>
            </div>         
          </div>
          <div class="form-group row">
            <label for="respuesta" class="col-12 col-form-label">Respuesta</label>
            @foreach ($admin as $element)
             @if ($element->email==$_COOKIE['email_login'])
              <input type="hidden" value="{{$element->id}}" name="admin">
             @endif
             @break
            @endforeach            
            <div class="col-12">
              <textarea class="form-control summernote" id="respuesta" name="respuesta">{{$comentario->respuesta_comentario}}</textarea>
            </div>
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
  $("#modalComenterio").modal();
</script>
  @endif
@endif

@if (Session::has("datos_error"))
  <script>
  notie.alert({
  type:2,
  text:'Datos no validos',
  time:7
  });
</script>
@endif
@if (Session::has("comentario_success"))
  <script>
  notie.alert({
  type:1,
  text:'Comentario actualizado correctamente',
  time:7
  });
</script>
@endif
@if (Session::has("comentario_error"))
  <script>
  notie.alert({
  type:3,
  text:'Error al actualizar comentario',
  time:7
  });
</script>
@endif
@if (Session::has("datos_vacio"))
  <script>
  notie.alert({
  type:2,
  text:'Datos Vacios',
  time:7
  });
</script>
@endif
  @endsection  