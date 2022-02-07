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

    <style>
      body {
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
      }
      .product_image {
        display: flex;
        justify-content: center;
      }
      .product_image img {
        width: 300px;
      }
      .saludo {
        margin-top: 30px;
        color: #000;
        text-align: center;
        font-size: 3rem;
      }
      .mensage {
        text-align: center;
        color: #000;
        font-size: 24px;
      }

    </style>

  </head>

  <body style="background-image: url('../images/index.jpeg');">
    <div class="container body" >

      <div class="product_image">
        <img 
          src="{{asset('images/logo_gora_2021.png')}}"
          alt="logo inversiones gora"
        >
      </div>              
      <h2 class="saludo">¡Hola!</h2>
      <p  class="mensage">Para autenticarse de click en el boton
      </p>
      <center>
        <a href="{{route('log.index')}}"  class="btn btn-danger btn-lg"> 
          Entrar
        </a>
    </center>
    </div>
  </body>
</html>
