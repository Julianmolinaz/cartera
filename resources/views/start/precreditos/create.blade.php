@section('title','Crear Solicitud')

@section('contenido')


<div class="row" id="obligacion">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Crear Solicitud de Crédito <small>-- {{$cliente->nombre.' -- '.$cliente->num_doc}}</small></div>
        <div class="panel-body">
          <form class="form-horizontal form-label-left" action="" method="POST">

            <div class="row">


              <!-- INFORMACION INICIAL Y DE PRODUCTOS -->


              <div class="col-md-6">
                @include('start.precreditos.componentes.info_inicial')
              </div>

              <!-- CONDICIONES DEL NEGOCIO  -->

              <div class="col-md-6">
                @include('start.precreditos.componentes.condiciones')
              </div>
            </div>

          </form>
        </div>
      </div>  
  </div>
</div>

@include('start.precreditos.componentes.create_js')

@endsection

@include('templates.main2')