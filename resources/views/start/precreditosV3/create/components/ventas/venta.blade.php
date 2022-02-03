<script type="text/x-template" id="venta-template">
    <div>
        <producto-component :producto="data.producto" :index="index"></producto-component>
        <template v-if="data.vehiculo">
            <div role="tabpanel" class="tab-pane  active" id="vehiculo" style="margin-left:10px;">
                <vehiculo-component :vehiculo="data.vehiculo" :index="index + 1" />
            </div>  
        </template>
    </div>
</script>

@include('start.precreditosV3.create.components.ventas.producto')
@include('start.precreditosV3.create.components.ventas.vehiculo')

<script src="{{ asset('js/SolicitudV3/Vehiculo.js') }}"></script>

<script>
    Vue.component("venta-component", {
        template: "#venta-template",
        props: {
            data: Object,
            index: Number,
        },
    })
</script>