<script type="text/x-template" id="producto-template">
    <form @submit.prevent="">
        <div class="row producto-container">
            <!-- NOMBRE DEL PRODUCTO -->

                <h1 class="producto-titulo">@{{ producto.nombre }}</h1>
 
            <!-- CLONAR PRODUCTO  -->
            <!-- <div class="form-group col-md-2" style="margin-top: 25px;" >
                <select class="form-control">
                    <option selected disabled>Clonar Vehículo</option>
                    <option value="">---</option>
                </select>
            </div> -->
            <!-- ELIMINAR PRODUCTO  -->
            <div class="producto-acciones">
                <a  href="javascript:void(0);" 
                    class="btn btn-default btn-xs producto-acciones__eliminar" 
                    title="ELiminar producto"
                    @click="eliminar"
                >
                    <span class="glyphicon glyphicon-trash"></span>
                </a>

            </div>

        </div>
        <hr v-if="!producto.con_vehiculo">
    </form> 
</script>

<script>
    Vue.component('producto-component', {
        template: '#producto-template',
        props: ['producto', 'index'],
        data() {
            return {
                name: 'venta component'
            }
        },
        methods: {
            alerta() {
                alert();
            },
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
<style scoped>
    .producto-container {
        padding: 5px 15px 5px 26px;
        margin: 0;
    }
    .producto-titulo {
        display: inline; 
        font-size: 3rem;
    }
    .producto-acciones {
        float:right;diplay:inline;
    }
    .producto-acciones__eliminar{
        font-size: 20px; 
        line-height: 1.5;
    }
</style>