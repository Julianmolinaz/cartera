<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title','Ingrese title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('contabilidad.templates.css')

</head>

<body>
    @include('contabilidad.templates.navbar')

    @yield('contenido','Ingrese contenido')

    @include('contabilidad.templates.js')    

    @yield('js')

</body>

</html>