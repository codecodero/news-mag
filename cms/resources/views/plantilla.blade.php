<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url('/') }}/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/plugins/bootstrap/css/bootstrap-4.min.css" />
    <link rel="stylesheet" href="{{url('/')}}/plugins/overlayscrollbars/css/overlayscrollbars.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/adminlte.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <title>News Mag</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('modulos.cabecera')
        @include('modulos.sidebar')
        @yield('contenido')
        @include('modulos.footer')
    </div>
    
<script src="{{url('/')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{url('/')}}/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/plugins/overlayscrollbars/js/overlayscrollbars.min.js"></script>
<script src="{{url('/')}}/js/adminlte.min.js"></script>
</body>

</html>