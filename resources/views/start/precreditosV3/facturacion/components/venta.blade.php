<script type="text/x-template" id="venta-template">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="'heading' + index">
            <div class="panel-title">
                <p class="panel-title__producto">
                    @{{ venta.producto.nombre }}
                    <span v-if="venta.producto.con_vehiculo">
                        - @{{ venta.vehiculo.placa }}
                    </span>
                </p>
                <a 
                    v-if="venta.producto.con_invoice"
                    role="button"
                    data-toggle="collapse"
                    data-parent="#accordion"
                    :href="'#collapse' + index"
                    aria-expanded="true"
                    :aria-controls="'collapse' + index"
                    class="btn btn-default btn-facturar"
                >
                    Facturar
                </a>
            </div>
        </div>
        <div 
            v-if="venta.producto.con_invoice"
            :id="'collapse' + index" 
            class="panel-collapse collapse in" 
            role="tabpanel" 
            :aria-labelledby="'heading'+index"
        >
            <div class="panel-body">

                <form @submit.prevent="onSubmit">
                    <div class="row col-md-12">
                        <div class="col-md-3 form-group">
                            <label for="estado">Estado</label>
                            <select
                                class="form-control"
                                v-model="factura.estado"
                            >
                                <option selected disabled></option>
                                <option
                                    v-for="estado in $store.state.insumos.estados"
                                    :value="estado"
                                >@{{ estado }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="expedido a">Expedido a</label>
                            <select 
                                class="form-control"
                                v-model="factura.expedido_a"
                            >
                                <option selected disabled></option>
                                <option 
                                    v-for="item in $store.state.insumos.expedidoA"
                                    :value="item"
                                >@{{ item }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="proveedor">Proveedor</label>
                            <select 
                                class="form-control"
                                v-model="factura.proveedor_id"
                            >
                                <option selected disabled></option>
                                <option 
                                    v-for="proveedor in $store.state.insumos.proveedores"
                                    :value="proveedor.id"
                                >@{{ proveedor.nombre }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="fecha de expedición">Fecha de expedición</label>
                            <input 
                                type="date"
                                class="form-control"
                                v-model="factura.fecha_exp"
                            >
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-3 form-group">
                            <label for="numero de factura">Número de factura</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="factura.num_fact"
                            >
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="costo">Costo</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="factura.costo"
                            >
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="iva">IVA</label>
                            <input
                                type="decimal"
                                class="form-control"
                                v-model="factura.iva"
                            >
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="otros pagos">Otros</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="factura.otros"
                            >
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-12 form-group">
                            <label for="estado">Observaciones</label>
                            <textarea
                                class="form-control"
                                v-model="factura.observaciones"
                            ></textarea>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <center>
                            <button class="btn pg-btn-dark">Guardar Cambios</button>
                        </center>
                    </div>
                </form>

            </div>
        </div>
    </div>
</script>

<script src="{{ asset('js/SolicitudV3/Invoice.js') }}"></script>

<script>
    const ventaComponent = Vue.component("venta-component", {
        template: "#venta-template",
        props: {
            venta: {
                type: Object,
            },
            index: {
                type: Number,
            }
        },
        data: () => ({
            modo: "",
            factura: "",
        }),
        methods: {
            onSubmit() {
                if (this.modo === 'Crear Factura') {
                    this.store();
                } else if (this.modo === 'Editar Factura')  {
                    this.update();
                } else {
                    alertify.alert("Error", "Opción no valida.");
                }
            },
            store() {
                axios.post('/api/facturacion', this.factura)
                    .then(res => {
                        console.log({res});
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            update() {

            }
        },
        created() {
            if (this.venta.producto.con_invoice) {
                if ( this.venta.factura && this.venta.factura.id) {
                    this.factura = new Invoice(this.venta.factura);
                    this.modo = "Editar Factura";
                } else {
                    this.factura = new Invoice({
                        precredito_id: this.venta.precredito_id,
                        venta_id: this.venta.id,
                        nombre: this.venta.producto.nombre
                    });
                    this.modo = "Crear Factura";
                }
            } else {
                this.modo = "Consultar de venta";
            }
        }
    });
</script>

<style scoped>
    .panel-heading {
        width: 100%;
        padding: 3rem 3rem;
        border-left: 0.4rem solid var(--color-sun) !important;
        border-radius: 3px 0 0 0;
        background-color: var(--color-light) !important;
    }
    .panel-title__producto {
        display: inline;
    }
    .btn-facturar {
        float: right;
        color: var(--color-dark) !important;
    }
</style>