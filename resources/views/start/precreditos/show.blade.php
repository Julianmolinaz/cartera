@section('title','ver solicitud')

@section('contenido')

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

@include('start.precreditos.go_pazysalvo')

@endsection
@include('templates.main2')

<script>

    const credito = {!! json_encode($precredito->credito) !!}
    

    function getPazYsalvo() {

        if ('{!! $precredito->cliente->codeudor !!}') {

            $('#valid_pys_modal').modal('show');

        } else {
            getPazYsalvoCliente();
        }

    }

    function getPazYsalvoCliente(){
        window.open(`/start/certificados/paz_y_salvo/${credito.id}/cliente`, '_blank');
        $('#valid_pys_modal').modal('hide');
    }

    function getPazYsalvoCodeudor(){ 
        window.open(`/start/certificados/paz_y_salvo/${credito.id}/codeudor`, '_blank');
        $('#valid_pys_modal').modal('hide');
    }

</script>

