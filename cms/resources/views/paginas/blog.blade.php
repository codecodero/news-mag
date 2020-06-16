  @extends('plantilla')
  @section('contenido')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sitio Web</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Blog</li>
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
           <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Datos del Sitio</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- @foreach ($blog as $item)                  
              @endforeach --}}
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="titulo-sitio" class="col-sm-2 col-form-label">Titulo Sitio</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="titulo-sitio" placeholder="Titulo Sitio" value="{{$blog[0]['titulo']}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="dominio" class="col-sm-2 col-form-label">Dominio</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="dominio" placeholder="Dominio" value="{{$blog[0]['dominio']}}">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="dominio" class="col-sm-2 col-form-label">CMS</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="dominio" placeholder="CMS" value="{{$blog[0]['cms']}}">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                    <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="descripcion" placeholder="Descripcion" rows="4">{{$blog[0]['descripcion']}}</textarea>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="palabras_claves" class="col-sm-2 col-form-label">Palabras Claves</label>
                    <div class="col-sm-10">
                      @php
                          $data=json_decode($blog[0]->palabras_claves,true);
                          $tags="";
                          foreach ($data as $key => $value) {
                            $tags.=$value.", ";
                          }
                      @endphp
                    <input type="text" class="form-control" id="palabras_claves" placeholder="Palabras Claves" value="{{$tags}}">
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group row">
                          <label for="" class="col-ms-2 col-md-3">Seleciona un Red Social</label>
                          <div class="col-sm-12 col-md-9">
                            <div class="form-group">
                              <select class="form-control">
                                <option value="fa fa-facebook-f">Facebook</option>
                                <option value="fa fa-youtube">YouTube</option>
                                <option value="fa fa-instagram">Instagram</option>
                                <option value="fa fa-twitter">Twitter</option>
                                <option value="fa fa-spotify">Spotify</option>
                              </select>
                            </div>                      
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group row">                                                    
                          <a href="#" class="btn btn-primary text-white"><i class="fas fa-plus-circle"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Redes Sociales Activos</label>
                      <div class="col-sm-12 col-md-8 col-lg-6">
                        @php
                            $data_redes=json_decode($blog[0]->redes_sociales,true);                     
                        @endphp  
                        @foreach ($data_redes as $item)                          
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="{{$item['icono']}}"></i></span>
                          </div>
                        <input type="text" class="form-control" id="" placeholder="" value="{{$item['url']}}">
                        <div class="input-group-append">
                          <span class="input-group-text">{{$item['red-social']}}</span>
                        </div>
                        </div>
                        @endforeach                           
                      </div>
                    </div>
                   <div class="form-group row">
                    <label for="sobre_mi" class="col-sm-2 col-form-label">Sobre Mi</label>
                    <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="sobre_mi" placeholder="Sobre Mi" rows="4">{{$blog[0]['sobre_mi']}}</textarea>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="dominio" class="col-sm-2 col-form-label">Último fecha de actualización</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="dominio" placeholder="Dominio" disabled value="{{$blog[0]['fecha']}}">
                    </div>
                  </div>            
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Actualizar Cambios</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection