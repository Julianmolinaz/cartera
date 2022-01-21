<!DOCTYPE html>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio! | </title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md" style="background-image: url('../images/index.jpeg');">
    <div class="container body" >
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
            <div class="product_image">
              <img src="{{asset('images/logo_gora_2021.png')}}" alt="..." width="300;">
            </div>              
              <br><br><br><br>
              <h2  style="color: #000;">¡Hola!</h2>
              <p  style="color: #000;">Para autenticarse de click en el boton
              </p>
              <div class="mid_center">

                <form>
                  <div class="col-xs-12 form-group pull-right top_search">
                    
                      <span >
                            <a href="{{route('log.index')}}"> 
                                <button type="button" class="btn btn-danger btn-lg">Entrar</button>
                             </a>
                          </span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>


  </body>
</html>
