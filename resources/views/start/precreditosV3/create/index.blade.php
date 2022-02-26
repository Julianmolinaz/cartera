@extends('templates.main2')
@section('title', 'solicitud')

@section('contenido')

<div class="col-lg-10 col-lg-offset-1 col-md-12" id="app">
    <main-component></main-component>
</div>

<script>
    Vue.use(VeeValidate)
    VeeValidate.Validator.localize("es");

    const Bus = new Vue();
</script>

@include('start.precreditosV3.create.components.main')
@include('start.precreditosV3.create.components.store')
@include('start.precreditosV3.create.components.ventas._index')
@include('start.precreditosV3.create.components.solicitud')
@include('start.precreditosV3.create.components.credito')

<script>
    const principal = new Vue({
        el: '#app',
        store,
    });
</script>

@endsection
