@extends('templates.main2')

@section('title', 'Facturacion')

@section('contenido')

<div id="app" class="col-md-offset-2 col-md-8">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <venta-component 
            v-for="(venta, i) in $store.state.ventas"
            :venta="venta"
            :index="i"
        ></venta-component>
    </div>
</div>

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