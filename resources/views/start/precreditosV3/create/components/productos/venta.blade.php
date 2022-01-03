<script type="text/x-template" id="venta-template">
    <form @submit.prevent="">

        <div class="row" style="margin-left:25px;">
                <!-- NOMBRE DEL PRODUCTO -->
            <div class="form-group col-md-7" @click="clonar">
                <h1>@{{ venta.nombre }}</h1>
            </div>
                <!-- CLONAR VEHICULO  -->
            <div class="form-group col-md-2" style="margin-top: 25px;" >
                <select class="form-control">
                    <option selected disabled>Clonar Vehículo</option>
                    <option value="">---</option>
                </select>
            </div>
                <!-- ELIMINAR PRODUCTO  -->
            <div class="form-group col-md-2" style="margin-top: 26px;">
                <a  href="javascript:void(0);" 
                    class="btn btn-default btn-xs" 
                    title="ELiminar producto"
                    @click="eliminar">
                    <span class="glyphicon glyphicon-trash" style="font-size: 20px; line-height: 1.5;"></span>
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
            clonar() {
                console.log(123);
            },
            eliminar() {
                console.log('eliminar');
                Bus.$emit('eliminarProducto', this.index);
            }
        },
        computed: {  
            
        },
        created() {
        }
    });
</script>