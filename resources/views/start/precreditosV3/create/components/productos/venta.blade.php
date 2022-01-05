<script type="text/x-template" id="venta-template">
    <form @submit.prevent="">

        <div class="row" style="margin-left:25px;">
                <!-- NOMBRE DEL PRODUCTO -->
            <div class="form-group col-md-7" @click="clonar">
                <h1>@{{ venta.nombre }}</h1>
            </div>
                <!-- CLONAR VEHICULO  -->
            <div class="form-group col-md-2" style="margin-top: 25px;" if="index > 0" >
                <a href="#" @click="clonar">Clonar vehiculo</a>
                <div style="width: 100px">
                    <ul>
                        <li v-for="vehiculo in this.$store.state.listaVehiculos">
                            <a href="#" @click="asignarVehiculo(vehiculo)">@{{ vehiculo.placa }}</a>
                        </li>
                    </ul>
                </div>
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
                name: 'venta component',
                list_vehiculos: []
            }
        },
        methods: {
            clonar() {
                // let clonar = document.getElementById('clonar'+index).value
                this.$store.commit("resetListaVehiculos");
                Bus.$emit("consultarVehiculo")
                console.log('clonar');
                    
            },
            setVehiculo(vehiculo) {
                
            },
            eliminar() {
                console.log('eliminar');
                Bus.$emit('eliminarProducto', this.index);
            }
        },
        computed: {  
            
        },
        created() {
            Bus.$on('consultarVehiculos', (vehiculo) => {
                console.log(vehiculo);
            })
        }
    });
</script>