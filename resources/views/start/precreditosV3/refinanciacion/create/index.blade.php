@extends('templates.main2')
@section('title', 'refinanciacion')

@section('contenido')
<div class="col-lg-10 col-lg-offset-1" id="app">
    <main-component
        :insumos="insumos"
        :solicitud-padre="solicitudPadre"
        :credito-padre="creditoPadre"
    ></main-component>
</div>

@include('start.precreditosV3.refinanciacion.create.main')

<script>
    const app = new Vue({
        el: "#app",
        data: {
            insumos: {!! json_encode($insumos) !!},
            solicitudPadre: {!! json_encode($solicitud) !!},
            creditoPadre: {!! json_encode($credito) !!}
        }
    })
</script>
@endsection