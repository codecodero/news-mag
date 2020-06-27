<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="{{$blog[0]['cms'].$blog[0]['icono']}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url('/') }}/plugins/bootstrap/bootstrap-4.min.css" />
    <link rel="stylesheet" href="{{url('/')}}/plugins/overlayscrollbars/overlayscrollbars.min.css">
    <link rel="stylesheet" href="{{url('/')}}/plugins/tags/taginput.css">
    <link rel="stylesheet" href="{{url('/')}}/plugins/summernote/summernote.css">
    <link rel="stylesheet" href="{{url('/')}}/plugins/notie/notie.min.css">
    <link rel="stylesheet" href="{{url('/')}}/plugins/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{url('/')}}/plugins/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/adminlte.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script>
    <script src="{{url('/')}}/plugins/jquery/jquery.min.js"></script>
    <script src="{{url('/')}}/plugins/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/plugins/overlayscrollbars/overlayscrollbars.min.js"></script>
    <script src="{{url('/')}}/plugins/tags/taginput.js"></script>
    <script src="{{url('/')}}/plugins/summernote/summernote.js"></script>
    <script src="{{url('/')}}/js/adminlte.min.js"></script>
    <script src="{{url('/')}}/plugins/notie/notie.min.js"></script>
    <script src="{{url('/')}}/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/plugins/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="{{url('/')}}/plugins/datatable/responsive.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/js/dashboard.js"></script>
    <script src="{{url('/')}}/js/admin.js"></script>
    <script src="{{url('/')}}/js/categorias.js"></script>
    <script src="{{url('/')}}/js/articulos.js"></script>
    <script src="{{url('/')}}/js/comentarios.js"></script>
    <script src="{{url('/')}}/js/banner.js"></script>
    <script src="{{url('/')}}/js/ads.js"></script>
    <title>News Mag</title>
</head>
@if (Route::has('login'))
@auth
<body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            @include('modulos.cabecera')
            @include('modulos.sidebar')
            @yield('contenido')
            @include('modulos.footer')
        </div>
@else
    <body class="hold-transition login-page">
    @include('paginas.login') 

@endauth
@endif
</body>

</html>