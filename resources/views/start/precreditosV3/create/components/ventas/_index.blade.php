<script type="text/x-template" id="ventas-template">
    <div class="row row-venta">
        <!-- AGREGADOR DE PRODUCTOS -->
        <div class="col-md-12 venta-container">
            <!-- PRODUCTO -->
            <div class="form-group col-md-4">
                <label for="">Producto @{{ rules.producto.required }}</label>  
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
            </div> 
            <!-- CANTIDAD -->
            <div class="form-group col-md-2">
                <label for="">Cantidad @{{ rules.cantidad.required }}</label>
                <select class="form-control"
                    v-model="cantidad"
                    v-validate="rules.cantidad.rule"
                    :name="rules.cantidad.name"
                >
                    <option 
                        :value="cantidad" 
                        v-for="cantidad in listCantidades"
                    >
                        @{{ cantidad }}
                    </option>
                </select>
            </div>
            <!-- AGREGAR PRODUCTO -->
            <div class="form-group col-md-2">
                <button class="btn btn-primary" @click="addProducto" style="margin-top:25px;">
                    Agregar Producto
                </button>
            </div> 

            <div class="col-md-4 venta-total-container">
                <span class="venta-total">$ @{{ sumTotal | formatPrice}}</span>
                <span class="venta-total-text">Total</span>
            </div>
        </div>

        <!-- PRODUCTOS AGREGADOS -->
        <div class="col-md-12 productos" v-if="listarVentas.length > 0">
            <div class="" style="padding:5px">
                <template v-for="(item, index) in listarVentas">
                    <venta-component :data="item" :index="index"></venta-component>
                </template>
            </div>
        </div>
    </div>
</script>

@include('start.precreditosV3.create.components.ventas.venta')
<script src="/js/rules/solicitudV3/index.js"></script>

<script>
    Vue.component('ventas-component', {
        template: '#ventas-template',
        data() {
            return {
                idx: 1,
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
            async continuar() {
                try {    
                    this.$store.commit('setPermitirSalvar', true);
                    await this.validarVehiculos();
                    await this.$store.dispatch("validarValorVentas");
                    this.goContinuar();
                } catch (error) {
                    alertify.alert("Error", error);
                }
            },
            goContinuar() {
                if (this.$store.getters.getContinuarASolicitud) {
                    this.$store.commit('setVentas', this.ventas);
                    $('.nav-tabs a[href="#solicitud"]').tab('show');
                } else {
                    alertify.notify('Por favor complete los campos', 'error', 5, () => {});
                }
            },
            async onSubmit() {
                try {    
                    this.$store.commit('setPermitirSalvar', true);
                    await this.$store.dispatch("validarVehiculos");
                    await this.$store.dispatch("validarValorVentas");
                    await this.goSubmit();
                } catch (error) {
                    alertify.alert("Error", error);
                }
            },
            async goSubmit() {
                if (this.$store.getters.getPermitirSalvar) {
                    this.$store.commit('setVentas', this.ventas);
                    this.$store.dispatch('onSubmit');
                } else {
                    alertify.notify('Por favor complete los campos', 'error', 5, function(){  });
                }
            }
        },
        computed: {
            sumTotal() {
                return this.$store.getters.getTotalVentas;
            },
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
<style>
.row-venta {
    margin: 0;
}
.productos {
    border-bottom: 1px solid #dddddd;
    margin-bottom: 2rem;
}
.venta-container {
    border-bottom: 1px solid #dddddd;
    /* margin-bottom: 30px; */
    padding-bottom: 10px;
}
.venta-total-container {
    display: flex; 
    align-items: center;
    flex-direction: column;
    /* gap: 1rem; */
}
.venta-total-text {
    font-size: 1.6rem;
}
.venta-total {
    font-size: 2.5rem;
}
</style>

