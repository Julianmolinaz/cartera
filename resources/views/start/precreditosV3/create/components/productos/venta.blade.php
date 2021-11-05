<script type="text/x-template" id="venta-template">
    <form @submit.prevent="">

        <div class="row" style="margin-left:25px;">
                <!-- NOMBRE DEL PRODUCTO -->
            <div class="form-group col-md-10">
                <h1>@{{ venta.nombre }}</h1>
            </div>
                <!-- ELIMINAR PRODUCTO  -->
            <div class="form-group col-md-2" style="margin-top: 25px;">
                <a  href="javascript:void(0);" 
                    class="btn btn-default btn-xs" 
                    title="ELiminar producto"
                    @click="eliminar">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
        </div>
        <hr>
    </form> 
</script>

<script>
    Vue.component('venta-component', {
        template: '#venta-template',
        props: ['venta', 'index'],
        data() {
            return {
                name: 'venta component'
            }
        },
        methods: {
            eliminar() {
                console.log('eliminar');
                Bus.$emit('eliminarProducto', this.index);
            }
        },
        created() {
        }
    });
</script>