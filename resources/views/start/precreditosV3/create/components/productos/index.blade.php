<script type="text/x-template" id="productos-template">
    <form @submit.prevent="" autocomplete="off">
        
        <div class="row">
            <div class="col-md-12">
                <!-- PRODUCTO -->
                <div v-bind:class="['form-group','col-md-4',errors.first(rules.producto.name) ? 'has-error' :'']">
                    <label for="">Producto @{{ rules.producto.required }}<span></span></label>  
                    <select class="form-control" 
                        v-model="productoSelected"
                        v-validate="rules.producto.rule"
                        :name="rules.producto.name">
                        <option selected disabled>Escoja producto</option>
                        <option 
                            :value="producto" 
                            v-for="producto in insumos.catalogo">
                            @{{ producto.nombre }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.producto.name) }}</span>
                </div> 
                <!-- CANTIDAD -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.producto.name) ? 'has-error' :'']">
                    <label for="">Cantidad @{{ rules.cantidad.required }}</label>
                    <select class="form-control"
                        v-model="cantidad"
                        v-validate="rules.cantidad.rule"
                        :name="rules.cantidad.name">
                        <option :value="cantidad" 
                            v-for="cantidad in listCantidades">
                            @{{ cantidad }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.cantidad.name) }}</span>
                </div>
                <!-- AGREGAR PRODUCTO -->
                <div class="form-group col-md-4">
                    <button class="btn btn-primary" @click="addProducto" style="margin-top:25px;" type="submit">
                        Agregar Producto
                    </button>
                </div> 
            </div>
            <!-- Tab panes -->
            <div class="tab-content" style="padding:5px">
                <div v-for="(item, index) in ventas">
                    <venta-component :venta="item.venta" :index="index"></venta-component>
                    <template v-if="item.vehiculo">
                        <div id="vehiculo" style="margin-left:10px;">
                            <vehiculo-component :vehiculo="item.vehiculo" />
                        </div>  
                    </template>
                </div>
            </div><!-- tab-content  -->

            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <a class="btn btn-default" href="">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>Salir
                        </a>
                        <button class="btn btn-primary" @click="onSubmit">
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>Salvar
                        </button>
                        <button type="submit" class="btn btn-default" @click="continuar">
                            <i class="fa fa-forward" aria-hidden="true"></i>Continuar
                        </button>
                    </center>
                </div>  
            </div>
            
        </div>                               

    </form>
</script>

@include('start.precreditosV3.create.components.productos.venta')
@include('start.precreditosV3.create.components.productos.vehiculo')

<script src="{{ asset('js/SolicitudV3/Venta.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Vehiculo.js') }}"></script>

<script src="/js/rules/solicitudV3/index.js"></script>

<script>
    Vue.component('productos-component', {
        template: '#productos-template',
        data() {
            return {
                cantidad    : 1,
                max_cantidad: 6,
                ventas: [],
                productoSelected: '',
                rules: rules_index
            }
        },
        methods: {
            addProducto() {
                if (this.productoSelected && this.cantidad) {
                    for (let index = 0; index < this.cantidad; index++) {
                        let element = {
                            venta: '',
                            vehiculo: ''
                        };
                        element.venta = new Venta({
                            nombre: this.productoSelected.nombre,
                            producto_id: this.productoSelected.id,
                            cantidad: this.cantidad
                        });
                        if (this.productoSelected.con_vehiculo) {
                            element.vehiculo = new Vehiculo({});
                            console.log(element.vehiculo);
                        }
                        this.ventas.push(element)
                    }
                } else {
                    alert('Se requieren escoger un producto y una cantidad');
                }
            },
            eliminarProducto(index) {
                const self = this;
                alertify.confirm('Eliminar Producto', '¿Está seguro de eliminar el producto?',
                    function() { self.ventas.splice(index,1) }, 
                    function(){ alertify.error('No se elimino ningun producto.',2) }
                );
            },
            isNotValid() {
                let result = false;
                let msg = '';
                
                if (!this.ventas.length) {
                    console.log(!this.ventas.length);
                    msg += "Se requiere agregar un producto<br>";
                    result = true;
                }
                if (msg) {
                    alertify.alert('Error', msg);
                }
                return result;
            },
            continuar() {
                if (this.isNotValid()) return false;

                this.$store.state.continuarASolicitud = true;
                
                Bus.$emit('validarComponents');

                setTimeout(() => {
                    if (this.$store.getters.getContinuarASolicitud) {
                        this.$store.commit('setVentas', this.ventas);
                        $('.nav-tabs a[href="#solicitud"]').tab('show');
                    } else {
                        alertify.notify('Por favor complete los campos', 'error', 5, function(){  });
                    }
                }, 1000);
            },
            onSubmit() {
                
            } 
        },
        computed: {
            listCantidades() {
                var contenedor = []
                for (let index = 0; index < this.max_cantidad ; index++) {
                    contenedor.push(index + 1);
                }
                return contenedor
            },
            insumos() {
              return this.$store.state.insumos
            },
        },
        created() {
            const self = this;
            Bus.$on('eliminarProducto', (index) => {
                this.eliminarProducto(index);
            });

            this.ventas = this.$store.state.ventas;
        }
    });
</script>

