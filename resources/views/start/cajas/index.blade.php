@section('title','Caja')
@section('contenido')

<div class="row" id="principal">
  
  <div class="col-md-4">
    <reporte-component></reporte-component>
  </div>
  <div class="col-md-8">
    <detalle-component></detalle-component>
  </div>
  @include('start.cajas.componentes.reporte')
  @include('start.cajas.componentes.detalle')
</div>

<script>

  var Bus = new Vue();
  
  var vm = new Vue({
    el:"#principal",
    data:{
      a:123
    }
  })
</script>

@endsection
@include('templates.main2')