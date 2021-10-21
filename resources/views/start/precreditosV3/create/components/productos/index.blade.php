<script type="text/x-template" id="productos-template">
    <form @submit.prevent="">
        
        <div class="row">
            <div class="col-md-12">
                <!-- PRODUCTO -->
                <div class="form-group col-md-4">
                    <label for="">Producto <span></span></label>  
                    <select class="form-control" v-model="productoSelected">
                        <option selected disabled>Escoja producto</option>
                        <option 
                            :value="producto" 
                            v-for="producto in catalogo"
                        >
                            @{{ producto.nombre }}
                        </option>
                    </select>
                </div> 
                <!-- CANTIDAD -->
                <div class="form-group col-md-2">
                    <label for="">Cantidad</label>
                    <select class="form-control"
                        v-model="cantidad">
                        <option :value="cantidad" v-for="cantidad in listCantidades">@{{ cantidad }}</option>
                    </select>
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
                <div v-for="item in ventas">
                    <venta-component :venta="item.venta"></venta-component>
                    <template v-if="item.invoice">
                        <div role="tabpanel" class="tab-pane  active" id="invoice" style="margin-left:10px;">
                            <invoice-component />
                        </div> 
                    </template>
                    <template v-if="item.vehiculo">
                        <div role="tabpanel" class="tab-pane  active" id="vehiculo" style="margin-left:10px;">
                            <vehiculo-component />
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
                        <button class="btn btn-primary" @click="update()">
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>Salvar
                        </button>
                        <button type="submit" class="btn btn-default" >
                            <i class="fa fa-forward" aria-hidden="true"></i>Continuar
                        </button>
                    </center>
                </div>  
            </div>
            
        </div>                               

    </form>
</script>

@include('start.precreditosV3.create.components.productos.invoice')
@include('start.precreditosV3.create.components.productos.venta')
@include('start.precreditosV3.create.components.productos.vehiculo')

<script src="{{ asset('js/SolicitudV3/Venta.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Invoice.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Vehiculo.js') }}"></script>

<script>
    Vue.component('productos-component', {
        template: '#productos-template',
        data() {
            return {
                cantidad    : 1,
                max_cantidad: 6,
                ventas: [],
                productoSelected: '',
            }
        },
        methods: {
            addProducto() {
                if (this.productoSelected && this.cantidad) {
                    for (let index = 0; index < this.cantidad; index++) {
                        let element = {
                            venta: '',
                            invoice: '',
                            vehiculo: ''
                        };
                        element.venta = new Venta({
                            nombre: this.productoSelected.nombre,
                            producto_id: this.productoSelected.id,
                            cantidad: this.cantidad
                        });
                        if (this.productoSelected.con_invoice) {
                            element.invoice = new Invoice({});
                        }
                        if (this.productoSelected.con_vehiculo) {
                            element.vehiculo = new Vehiculo({});
                        }
                        this.ventas.push(element)
                    }
                } else {
                    alert('Se requieren escoger un producto y una cantidad');
                }
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
            catalogo() {
              return this.$store.state.catalogo
            },  
        }
    });
</script>

