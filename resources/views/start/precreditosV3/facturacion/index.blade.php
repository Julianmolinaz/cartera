@extends('templates.main2')

@section('title', 'Facturacion')

@section('contenido')

@include('start.precreditosV3.show.styles')

<div class="col-md-offset-2 col-md-8">
    @include('flash::message')
    <div class="info-cliente" style="justify-content:space-between;flex-wrap: wrap;align-items:center;">
        <div style="display: flex;gap: 1rem; align-items:center;flex-wrap:wrap;">
            @permission('consultar_clientes')
                <a 
                    href="{{ route('start.clientes.show', $cliente->id) }}"
                    class='btn btn-default btn-xs my-btn'
                    data-toggle="tooltip" 
                    data-placement="top" 
                    title="Ver cliente"
                >
                    <span class="glyphicon glyphicon-user"></span>
                </a>
            @endpermission
            <h5>Cliente: {{ $cliente->nombre }}</h5> | 
            <span>{{ $cliente->tipo_doc }}: {{ $cliente->num_doc }}</span> |  
            <span>Tel: {{ $cliente->movil }}</span> |
            @if($credito) 
                <h5>Crédito ={{ $credito->id }}</h5>
            @else
                <h5>Solicitud ={{ $solicitud->id }}</h5>
            @endif
        </div>
        <a  href="{{ route('start.precreditosV3.show', $solicitud->id) }}"
            class="btn btn-default"
            style=""
        ><i class="fa fa-paper-plane" aria-hidden="true"></i> Volver
        </a>
    </div>
</div>

<div id="app" class="col-md-offset-2 col-md-8">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <venta-component 
            v-for="(venta, i) in $store.state.ventas"
            :venta="venta"
            :index="i"
        ></venta-component>
    </div>
</div>

@include('utils.general')
@include('start.precreditosV3.facturacion.components.venta')
@include('start.precreditosV3.facturacion.components.store')
<script>
    const main = new Vue({
        el: "#app",
        store,
        data: {},
    });
</script>

@endsection