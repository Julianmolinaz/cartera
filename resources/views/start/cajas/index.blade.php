@section('title','Caja')
@section('contenido')

<div class="row" id="principal">
  
  <div class="col-md-4">
    <reporte-component></reporte-component>
  </div>
  @include('start.cajas.componentes.reporte')
</div>

<script>
  
  var vm = new Vue({
    el:"#principal"
  })
</script>

@endsection
@include('templates.main2')