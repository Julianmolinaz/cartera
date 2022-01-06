<script type="text/x-template" id="ventas-template">
    <form @submit.prevent="" autocomplete="off">
        
        <div class="row">
            <div class="col-md-12">
                <!-- PRODUCTO -->
                <div v-bind:class="['form-group','col-md-4',errors.first(rules.producto.name) ? 'has-error' :'']">
                    <label for="">Producto @{{ rules.producto.required }}<span></span></label>  
                    <select class="form-control" 
                        v-model="productoSelected"
                        v-validate="rules.producto.rule"
                        :name="rules.producto.name"
                    >
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
                        :name="rules.cantidad.name"
                    >
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
                <div v-for="(item, index) in listarVentas">
                    <venta-component :data="item" :index="index"></venta-component>
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

@include('start.precreditosV3.create.components.ventas.venta')
<script src="/js/rules/solicitudV3/index.js"></script>

<script>
    Vue.component('ventas-component', {
        template: '#ventas-template',
        data() {
            return {
                cantidad: 1,
                max_cantidad: 6,
                productoSelected: '',
                rules: rules_index
            }
        },
        methods: {
            addProducto() {
                this.$store.dispatch("agregarVenta", {
                    producto: this.productoSelected,
                    cantidad: this.cantidad
                });
            },
            eliminarProducto(index) {
               this.$store.dispatch("eliminarVenta", index);
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
            listarVentas() {
                return this.$store.state.ventas;
            },
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

