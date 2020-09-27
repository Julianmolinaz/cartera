@extends('contabilidad.templates.main')

@section('contenido')
    <div id="pago_proveedores">

        <div class="container">
            <div class="row mt-3">
                <div class="col-md-4">
                    <pago_proveedores-component :proveedores="proveedores"></pago_proveedores-component>
                </div>
                <div class="col-md-8">
                    <detalle-component></detalle-component>
                </div>
            </div>
        </div>
    </div>

    @section('js')

        @include('contabilidad.pago_proveedores.list')
        @include('contabilidad.pago_proveedores.detalle')

        <script>

            var Bus = new Vue();

            const pago_proveedores = new Vue({
                el: '#pago_proveedores',
                data: {
                    proveedores: {!! json_encode($proveedores_en_debe) !!}
                },
                methods: {
                    getProveedores(proveedor_id,type){
                       
                    }
                },
                created(){

                }
            });
        </script>
    
    @endsection

@endsection