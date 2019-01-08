@section('title','crear factura')

@section('contenido')


<div class="row" id="main">
  <div class="col-sm-1">
  </div>
  <div class="col-sm-6">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!--panel generador de pagos-->
        @include('start.facturas.facturar.generador_de_pagos')
        <!--end panel generador de pagos-->
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!--panel resumen de pagos-->

        @include('start.facturas.facturar.listado_de_pagos')
        <!--end panel resumen de pagos-->
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <!--panel información de los pagos-->
    @include('start.facturas.facturar.info_general')
    <!--end panel información de los pagos-->

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
  @include('start.facturas.facturar.pagos')
  </div>
</div>

@include('mis_js.factura_create_js')
@include('start.pagos.print_js')

@endsection
@include('templates.main2')