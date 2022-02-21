<script type="text/x-template" id="producto-template">
    <div class="producto-container">
        <!-- NOMBRE DEL PRODUCTO -->
        <div class="producto-info">
            <h1 class="producto-titulo">@{{ index + 1 + '-' + producto.nombre }}</h1>
            <div>
                <input
                    type="number"
                    class="form-control"
                    style="width:12rem"
                    placeholder="valor producto"
                    v-model="valorVenta"
                    @keyup="changeValorVenta"
                >
                <span class="help-block" v-if="valorVenta > 0">$ @{{ valorVenta | formatPrice }}</span>
            </div>
        </div>

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
</script>

<script>
    Vue.component('producto-component', {
        template: '#producto-template',
        props: ['producto', 'index'],
        data() {
            return {
                name: 'venta component',
                activeClone: false,
                valorVenta: "",
            }
        },
        methods: {
            changeValorVenta() {
                this.$store.commit("setValorVenta", {
                    index: JSON.parse(JSON.stringify(this.index)),
                    valor: this.valorVenta
                });

                // this.$store.commit("setTotalVentas");
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
            },
        },
        computed: {  
            vehiculosAClonar() {
                return this.$store.getters.getVehiculosAClonar;
            }
        },
        created() {
            if (this.$store.state.modo !== "Crear Solicitud") {
                this.valorVenta = JSON.stringify(this.$store.state.ventas[this.index].valor);
            }
        }
    });
</script>
<style scoped>
    .producto-container {
        display: flex;
        /* align-items: center; */
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        margin: 3rem 1rem;
    }
    .producto-info {
        display: flex;
        align-items: start;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .producto-titulo {
        display: inline; 
        margin: 0;
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