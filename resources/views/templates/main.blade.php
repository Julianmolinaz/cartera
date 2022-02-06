<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

 
  <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" />

  <title>@yield('title','Ingrese title') </title>

  @include('templates.enlacescss') 

</head>


<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-universal-access"></i><span>Inversiones Gora</span></a>
          </div>

          <div class="clearfix"></div>


          <br />

          <!-- menu vertical -->
          @include('templates.menu_vertical')
          <!-- /menu vertical -->

          <!-- /menu footer vertical buttons -->
          @include('templates.menu_footer_vertical') 
          <!-- /menu footer vertical buttons -->
        </div>
      </div>

      <!-- top navigation superior -->
      @include('templates.top_navigation')
      <!-- /top navigation superior-->

      <!-- page content -->

        <div class="right_col" role="main">
            <div class="">
                @yield('contenido','Ingrese contenido')
            </div>
        </div>
    

      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  @include('templates.scripts')

</body>
</html>
