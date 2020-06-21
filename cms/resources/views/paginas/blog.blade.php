  @foreach ($admin as $element)
  @if ($element->email==$_COOKIE['email_login'])
  @if ($element->rol==1)
  @extends('plantilla')
  @section('contenido')
  <div class="content-wrapper">
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
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <form class="form-horizontal" action="{{url('/')}}/blog/{{$blog[0]['id']}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="col-12">
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">Datos del Sitio</h3>
                <button type="submit" class="btn btn-primary float-right">Actualizar cambios</button>
              </div>              
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="icono" class="col-md-4">Incono del sitio</label>
                        <div class="input-group col-md-8">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="icono" name="icono" >
                            <label class="custom-file-label" for="icono">Selecionar icono</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Subir</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="">
                        <input type="hidden" name="icono_actual" required value="{{$blog[0]['icono']}}">
                        <img class="direct-chat-img img_icono" src="{{$blog[0]['cms'].$blog[0]['icono']}}" alt="{{$blog[0]['titulo']}}">                            
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="logo" class="col-md-4">Logo del sitio</label>
                        <div class="input-group col-md-8">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="logo" >
                            <label class="custom-file-label" for="logo">Selecionar Logo</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Subir</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="bg-dark">
                        <input type="hidden" name="logo_actual" required value="{{$blog[0]['logo']}}">
                        <img class="figure-img img_logo" width="200" src="{{$blog[0]['cms'].$blog[0]['logo']}}" alt="{{$blog[0]['titulo']}}">                            
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card">
                          <div class="widget-user-header text-white" >
                            <img class="img-thumbnail img_portada" src="{{$blog[0]['cms'].$blog[0]['portada']}}" alt="{{$blog[0]['titulo']}}">
                          </div>
                          <div class="card-footer">
                            <div class="row ml-2">
                              <div class="form-group row">                              
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="hidden" name="portada_actual" required value="{{$blog[0]['portada']}}">
                                    <input type="file" class="custom-file-input" id="portada" name="portada">
                                    <label class="custom-file-label" for="portada">Selecionar portada</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="">Subir</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="card">
                            <div class="widget-user-header text-white" >
                              <img class="img-thumbnail img_info" src="{{$blog[0]['cms'].$blog[0]['img_sobre_mi']}}" alt="{{$blog[0]['titulo']}}">                              
                            </div>
                            <div class="card-footer">
                              <div class="row ml-2">
                                <div class="form-group row">                              
                                  <div class="input-group">
                                    <div class="custom-file">
                                    <input type="hidden" name="img_info_actual" required value="{{$blog[0]['img_sobre_mi']}}">
                                    <input type="file" class="custom-file-input" id="info" name="img_info" >
                                      <label class="custom-file-label" for="img_info">Selecionar imagen info</label>
                                    </div>
                                    <div class="input-group-append">
                                      <span class="input-group-text" id="">Subir</span>
                                    </div>
                                  </div>
                                </div>                               
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="titulo-sitio" class="col-sm-2 col-form-label">Titulo Sitio</label>
                    <div class="col-sm-10">
                      <input name="titulo_sitio" type="text" class="form-control" id="titulo-sitio" placeholder="Titulo Sitio" value="{{$blog[0]['titulo']}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="dominio" class="col-sm-2 col-form-label">Dominio</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="dominio" id="dominio" placeholder="Dominio" value="{{$blog[0]['dominio']}}">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="cms" class="col-sm-2 col-form-label">CMS</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="cms" id="cms" placeholder="CMS" value="{{$blog[0]['cms']}}">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                    <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" rows="4">{{$blog[0]['descripcion']}}</textarea>
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
                    <input type="text" class="form-control" name="palabras_claves" id="palabras_claves" placeholder="Palabras Claves" value="{{$tags}}" data-role="tagsinput">
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group row">
                          <label for="" class="col-ms-2 col-md-6">Seleciona un Red Social</label>
                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                              <select class="form-control" name="icono_redes" id="icono_redes">
                                <option value="0">--Seleccionar--</option>
                                <option value="fa fa-facebook-f">Facebook</option>
                                <option value="fa fa-youtube">YouTube</option>
                                <option value="fa fa-instagram">Instagram</option>
                                <option value="fa fa-twitter">Twitter</option>
                                <option value="fa fa-spotify">Spotify</option>
                                <option value="fab fa-linkedin">Linkedin</option>
                                <option value="fab fa-tumblr">Tumbler</option>
                              </select>
                            </div>                      
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-8">
                        <div class="form-group row"> 
                          <div class="col-md-9">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                                <input type="text" class="form-control" id="link_red" value="Pega aquí el link">
                              </div>
                          </div>
                          <div class="col-md-3">
                            <a href="#" class="btn btn-primary text-white" id="btn_add_red"><i class="fas fa-plus-circle"></i></a>
                          </div>
                          </div>
                      </div>
                    </div>
                    <input type="hidden" name="redes_sociales" id="redes_sociales" value="{{$blog[0]['redes_sociales']}}">
                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Redes Sociales Activos</label>
                      <div class="col-sm-12 col-md-8 col-lg-6" id="socials">
                        @php
                            $data_redes = json_decode($blog[0]->redes_sociales,true);
                        @endphp
                        @foreach ($data_redes as$key=> $item)
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="{{$item['icono']}}"></i></span>
                          </div>
                          <input type="text" class="form-control" placeholder="" value="{{$item['url']}}">
                          <div class="input-group-append">
                            <span class="btn btn-danger eliminar_red" data-url="{{$item['url']}}" >&times;</span>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                   <div class="form-group row">
                    <label for="sobre_mi" class="col-sm-2 col-form-label">Sobre Mi</label>
                    <div class="col-sm-10">
                    <textarea type="text" name="info" class="form-control summernote" id="sobre_mi" placeholder="Sobre Mi" rows="4">{{$blog[0]['sobre_mi']}}</textarea>
                    </div>
                  </div>
                    <div class="form-group row">
                      <label for="fecha_update" class="col-sm-2 col-form-label">Último fecha de actualización</label>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" id="fecha_update" placeholder="fecha d actualizacion" disabled value="{{$blog[0]['updated_at']}}">
                      </div>
                    </div>            
                  </div>
                  <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Actualizar Cambios</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
@if(Session::has("img-error"))
  <script>
  notie.alert({
    type:2,
    text:'Una de las imagenes tiene el formato incorrecto',
    time:7    
  });
  </script> 
@endif

   @if(Session::has("error-update"))
  <script>
  notie.alert({
    type:3,
    text:'Error al actualizar los datos',
    time:7    
  });
  </script> 
  @endif

   @if(Session::has("error-validation"))
  <script>
  notie.alert({
    type:2,
    text:'Ingrese datos validos',
    time:7    
  });
  </script> 
  @endif

   @if(Session::has("success-update"))
  <script>
  notie.alert({
    type:1,
    text:'Datos actualizados correctamente',
    time:7    
  });
  </script> 
  @endif
  @if(Session::has("error-vacio"))
    <script>
    notie.alert({
      type:2,
      text:'Todos los campos deben estar llenos',
      time:7    
    });
  </script> 
  @endif
  @endsection
  @else
  <script type="text/javascript">
    window.location="{{url('/')}}/categorias";
  </script>
  @endif         
  @endif
@endforeach