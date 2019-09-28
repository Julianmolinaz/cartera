@section('title','ver solicitud')

@section('contenido')

<div class="row">

    <!-- Información solicitud -->

    <div class="col-md-6 col-md-offset-1">
        @include('start.precreditos.precredito')
    </div>

    <!-- Información crédito -->

    <div class="col-md-4">
        @include('start.precreditos.credito')
    </div>
</div>

<!-- Pagos por solicitud  -->

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @include('start.precreditos.pagos_precredito')
    </div>
</div>

<!-- Pagos por crédito  -->

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        @include('start.precreditos.pagos_credito')
    </div>
</div>

@include('start.pagos.print_js')

@endsection
@include('templates.main2')

@include('start.precreditos.js')