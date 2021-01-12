@section('title','factura solicitud')

@section('contenido')

<div class="row" id="main">
  <div class="col-sm-1">
  </div>
  <div class="col-sm-6">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!--panel generador de pagos-->
        <generador-component></generador-component>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!--panel resumen de pagos-->
        <list_pagos_generados-component></list_pagos_generados-component>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <!--panel información de los pagos-->
    @include('start.facturas.fact_precredito.facturar.info_general')
  </div>
  <div class="col-sm-1"></div>

  <form class="form-horizontal form-label-left">
    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
    <input type="hidden" name="datos" id="datos" value="">
  </form>

</div>

<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
    @include('start.facturas.fact_precredito.pagos_realizados')
  </div>
</div>

@include('start.facturas.fact_precredito.facturar.generador_de_pagos')
@include('start.facturas.fact_precredito.facturar.list_pagos_generados')
<!-- @include('start.pagos.print_js') -->
<script>

  const Bus = new Vue();

  const main = new Vue({
    el:'#main',
  });

</script>
@endsection
@include('templates.main2')