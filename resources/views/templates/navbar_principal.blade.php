<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

      <img alt="Brand" src="{{asset('images/gora_logo_mini.png')}}" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

     <!--  <a class="navbar-brand" href="#">Gora</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
     


        <li class="">
            <a href="https://www.youtube.com/playlist?list=PLsemkTJmzpHvDs6ha0BMZ9ECkeO8GfKtx" target="_blank" 
             data-toggle="tooltip" data-placement="top" title="Ayuda">
                <i data-toggle="tooltip" data-placement="bottom" title="Ver Tutoriales"><b>GoFin-3000!</b></i>
            </a> 
        </li>
        <li class=""><a href="{{route('start.simulador.index')}}">Simulador <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientes <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('start.clientes.index')}}">Ver Clientes</a></li>
            <li><a href="{{route('start.clientes.create')}}">Crear Cliente</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{route('call.index')}}">=) CallCenter Todos</a></li>
            <li><a href="{{route('call.morosos')}}">=) CallCenter Morosos</a></li>
            <li><a href="{{route('call.agendados')}}">=) CallCenter Agendados</a></li>
            <li><a href="{{route('call.miscall')}}">=) Mis Call</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Obligaciones <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('start.creditos.index')}}">Ver Creditos</a></li>
            <li><a href="{{route('start.precreditos.index')}}">Ver Solicitudes</a></li> 
            <li><a href="{{route('start.creditos.cancelados')}}">Ver Cancelados</a></li>
          </ul>
        </li> 

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pagos <span class="caret"></span></a>
          <ul class="dropdown-menu">


            <li><a href="{{route('start.pagos.inicio')}}">Hacer Pago</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{route('start.facturas.index')}}">Ver Facturas Créditos</a></li>
            <!-- <li><a href="{{route('start.pagos')}}">Ver Pagos Créditos</a></li>  -->
            <li><a href="{{route('start.anuladas.index')}}">Ver Facturas Anuladas</a></li> 
            <li role="separator" class="divider"></li>
            <li><a href="{{route('start.pagos.index_otros_ingresos')}}">Ver Otros Ingresos</a></li> 

          </ul>
        </li>   

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href="{{route('admin.egresos.index')}}">Egresos</a></li>
            <li><a href="{{route('admin.multas.index')}}">Multas</a></li>
            
            <li role="separator" class="divider"></li>
            <li><a href="{{route('admin.reportes.index')}}">Reportes &nbsp;<i class="fas fa-chart-line"></i></a></li>

            <li role="separator" class="divider"></li>
            <li><a href="{{route('admin.carteras.index')}}">Carteras</a></li> 
            <li><a href="{{route('admin.puntos.index')}}">Puntos</a></li>   
            <li><a href="{{route('admin.users.index')}}">Usuarios</a></li>
                      
            <li role="separator" class="divider"></li>
            <li><a href="{{route('admin.productos.index')}}">Productos</a></li>
            <li><a href="{{route('admin.variables.index')}}">Variables &nbsp;<i class="fas fa-cogs"></i></a></li>
            <li><a href="{{route('admin.criteriocall.index')}}">Criterios de llamada</a></li>
            <li><a href=""></a></li> 

          </ul>
        </li> 

        <li>
          <a href="{{route('start.inicio.index')}}"  id="btn_registro" >
            <span class = "glyphicon glyphicon-search" data-toggle="tooltip" data-placement="bottom" title="Buscador"></span>
          </a>
        </li>

        
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" >{!! Auth::user()->rol!!}</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
          role="button" aria-haspopup="true" aria-expanded="false">{!! Auth::user()->name!!} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ route('start.cajas.index') }}">
                <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Caja
              </a>
            </li>
            <li><a href="{{route('wiki')}}">Wiki-Gofin!</a></li>
            <li><a href="/logout">Salir</a></li>
          </ul>
        </li>


      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script>
    document.addEventListener ("keydown", function (e) {
        //alert(e.which);
        if (e.altKey  &&  e.which === 78) {
            window.location.href = "{{ url('start/inicio/index') }}";
        }
        else if (e.altKey  &&  e.which === 83) {
            window.location.href = "{{route('start.simulador.index')}}";
        }
        else if (e.altKey  &&  e.which === 67) {
            window.location.href = "{{route('start.clientes.index')}}";
        }
        else if (e.altKey  &&  e.which === 79) {
            window.location.href = "{{route('start.creditos.index')}}";
        }
        else if (e.altKey  &&  e.which === 80) {
            window.location.href = "{{route('start.pagos.inicio')}}";
        }
          
    });
</script>