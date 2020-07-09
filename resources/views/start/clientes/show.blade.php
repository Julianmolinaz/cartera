@section('title','Ver Cliente')
@section('contenido')

<div class="row">
  <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    @include('flash::message')
  </div>
  <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">

    <div class="col-md-6  col-sm-6 col-xs-12">
      
      @include('start.clientes.info.cliente')

    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      @if($cliente->codeudor)
        @include('start.clientes.info.codeudor')
      @elseif($cliente->cdeudor)
        @include('start.clientes.info.cdeudor')
      @else
      <div style="margin: 0px auto;
          width: 100%;
          height: 84vh;
          display: flex;
          align-items: center;
          justify-content: center;">
        <a href="{{route('start.clientes.create',['codeudor',$cliente->id])}}" 
          class='btn btn-primary'>
          <span class = "glyphicon glyphicon-plus-sign"></span>
          Crear Codeudor
        </a>
      </div>
      @endif
    </div>
  
  </div>

</div>

<!-- *** End Panel del codeudor ***-->

<!--  Inicio Panel de Precreditos-->
  <br>

<div class="row">

    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
      @include('start.clientes.info.solicitudes')
    </div>


</div>
<!--  End Panel de Precreditos-->

@endsection
@include('templates.main2')
