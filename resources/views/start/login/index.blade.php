<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gora Login </title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login" style="color: rgba(84,35,39,0.81)">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">          
            {{  Form::open(['route' => 'log.store', 'method'=>'POST']) }}
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" required="" name="email" autofocus />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Contraseña" required="" name="password" />
              </div>
              <div>
              <button type="submit" class="btn btn-default submit btn-sm">Log in</button>
                
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1> Negocios Gora</h1>
                  <p>©2017 Todos los derechos reservados. Gora. Privacidad y Términos</p>
                </div>
              </div>
            {{ Form::close() }}
          </section>
          @include('flash::message')
        </div>

      </div>
    </div>
  </body>
</html>
