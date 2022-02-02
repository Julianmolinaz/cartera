<script type="text/x-template" id="venta-template">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="'heading' + index">
            <div class="panel-title">
                <p class="panel-title__producto">
                    @{{ venta.producto.nombre }}
                    <span v-if="venta.producto.con_vehiculo">
                        - @{{ venta.vehiculo.placa }}
                        @{{ venta.factura && venta.factura.id ? '- ' + venta.factura.estado : '- Sin facturar'}} 
                    </span>
                </p>
                <div class="buttons-facturar">
                    <a 
                        v-if="venta.producto.con_invoice"
                        role="button"
                        data-toggle="collapse"
                        data-parent="#accordion"
                        :href="'#collapse' + index"
                        aria-expanded="true"
                        :aria-controls="'collapse' + index"
                        class="btn btn-default"
                    >
                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                        Facturar
                    </a>
                    <a  
                        style="margin-left:1rem;"
                        href="javascript:void(0);" 
                        class="btn btn-default" 
                        title="ELiminar factura"
                        @click="eliminarFactura()"
                    >
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </div>
            </div>
        </div>
        <div 
            v-if="venta.producto.con_invoice"
            :id="'collapse' + index" 
            class="panel-collapse collapse" 
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
                if (this.modo === 'Crear Factura') this.store();
                else if (this.modo === 'Editar Factura') this.update();
                else alertify.alert("Error", "Opción no valida.");
            },
            store() {
                axios.post('/api/facturacion/store', this.factura)
                    .then(res => {
                        if (res.data.success) {
                            alertify.alert('Confirmación', res.data.message, () => {
                                location.reload();
                            });
                        } else {
                            if (res.data.dat === 1) {
                                alertify.alert("Error en validación", showErrorValidation(res.data.message));
                            } else {
                                alertify.alert("Ha ocurrido un error", res.data.message);
                            }
                        }
                    })
                    .catch(error => {
                        alertify.alert("Ha ocurrido un error", error.message);
                    });
            },
            update() {
                axios.post('/api/facturacion/update', this.factura)
                    .then(res => {
                        if (res.data.success) {
                            alertify.alert('Confirmación', res.data.message, () => {
                                location.reload();
                            });
                        } else {
                            if (res.data.dat === 1) {
                                alertify.alert("Error en validación", showErrorValidation(res.data.message));
                            } else {
                                alertify.alert("Ha ocurrido un error", res.data.message);
                            }
                        }
                    })
                    .catch(error => {
                        alertify.alert("Ha ocurrido un error", error.message);
                    });
            },
            eliminarFactura() {
                alert();
            }
        },
        created() {
            if (this.venta.producto.con_invoice) {
                
                if ( this.venta.factura && this.venta.factura.id) {
                    this.modo = "Editar Factura";
                    this.factura = new Invoice(this.venta.factura);
                } else {
                    this.modo = "Crear Factura";
                    this.factura = new Invoice({
                        precredito_id: this.venta.precredito_id,
                        venta_id: this.venta.id,
                    });
                }
            } else {
                this.modo = "Consultar venta";
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
    .buttons-facturar {
        float: right;
        color: var(--color-dark) !important;
    }
</style>