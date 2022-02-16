<script type="text/x-template" id="producto-template">
    <form @submit.prevent="">
        <div class="row producto-container">
            
            <!-- NOMBRE DEL PRODUCTO -->
            <h1 class="producto-titulo">@{{ index + 1 + '-' + producto.nombre }}</h1>

            <div class="producto-acciones">
                <!-- CLONAR PRODUCTO  -->
                <div class="producto-acciones__clonar">
                    <a  
                        href="javascript:void(0);" 
                        class="btn btn-default" 
                        @click="listarVehiculosAClonar"
                        id="btn-listarVehiculosAClonar"
                        v-if="producto.con_vehiculo"
                    >Clonar vehículo</a>
                    
                    <!-- LISTADO DE PLACAS A CLONAR -->

                    <ul v-bind:class="[activeClone ? 'listVehiculosAClonar--acitve' : 'listVehiculosAClonar']">
                        <li v-for="vehiculo in vehiculosAClonar">
                            <a 
                                href="javascript:void(0);" 
                                @click="clonar(vehiculo)"
                            >@{{ vehiculo.placa }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- ELIMINAR PRODUCTO  -->
                <div class="eliminar-container">
                    <a  href="javascript:void(0);" 
                        class="btn btn-danger btn-xs producto-acciones__eliminar" 
                        title="ELiminar producto"
                        @click="eliminar"
                    ><span class="glyphicon glyphicon-trash"></span>
                    </a>
                </div>

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
                name: 'venta component',
                activeClone: false,
            }
        },
        methods: {
            alerta() {
                alert();
            },
            listarVehiculosAClonar() {
                this.$store.dispatch("listarVehiculosAClonar");

                if (this.$store.state.vehiculos.length > 0)
                    this.activeClone = !this.activeClone;
            },
            clonar(vehiculo) {
                this.$store.dispatch("clonarVehiculo", {
                    vehiculo, 
                    index: this.index
                });

                this.activeClone = !this.activeClone;
            },
            eliminar() {
                Bus.$emit('eliminarProducto', this.index);
            }
        },
        computed: {  
            vehiculosAClonar() {
                return this.$store.getters.getVehiculosAClonar;
            }
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
        display: flex;
        gap: 10px;
        float:right;
    }
    .producto-acciones__eliminar{
        font-size: 16px; 
    }
    .listVehiculosAClonar {
        display: none;
    }
    .listVehiculosAClonar--active {
        display: block;
    }
    .producto-acciones__clonar ul {
        border: solid 1px #cccccc;
        border-radius: 4px;
        list-style: none;
        padding: 6px 0;
        z-index: 900;
        position: absolute;
        width: 123px;
        background-color: #ffffff;
    }
    .producto-acciones__clonar a {
        text-decoration: none;
        color: #333333;
    }
    
    .producto-acciones__clonar li:hover {
        background-color: #efefef;
    }
    .producto-acciones__clonar ul a {
        display: block;
        width: 100%;
        padding: 0 12px;

    }
    .producto-acciones__clonar ul li {
        padding: 4px 0;
    }
    .eliminar-container {
        padding-top: 2px;
    }
</style>