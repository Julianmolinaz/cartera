@extends('templates.main2')

@section('title', 'Facturacion')

@section('contenido')

<div id="app" class="col-md-offset-2 col-md-8">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div style="display: flex; justify-content: end; padding: 10px 0">
            <a href="{{ route('start.precreditosV3.show', $solicitud->id) }}" class="btn btn-default">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                Volver
            </a>
        </div>
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
        data: {
           
        },
    });
</script>

@endsection