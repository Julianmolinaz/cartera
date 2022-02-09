<script type="text/x-template" id="venta-template">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" :id="'heading' + index">
            <div class="panel-title">
                <div class="panel-title__producto">
                    <p>
                        @{{ index + 1 + '- ' + venta.producto.nombre }}
                        <span v-if="venta.factura">
                            @{{ venta.factura && venta.factura.num_fact ? 
                                '-  # ' + venta.factura.num_fact + ' - ' + venta.factura.estado 
                                : '- Sin facturar'}}
                            </span>
                    </p>
                    <div>
                        <ul class="invoices-cambios">
                            <li v-if="venta.producto.con_vehiculo && venta.vehiculo">
                                <div class="invoices-cambios__item">
                                    <div>Vehículo</div>
                                    <div>@{{ venta.vehiculo.placa }}</div>
                                    <div></div>
                                </div>
                            </li>
                            <li v-if="venta.factura && venta.factura.created_by">
                                <div class="invoices-cambios__item">
                                    <div>Creó</div>
                                    <div>@{{ venta.factura.creator }}</div>
                                    <div>@{{ venta.factura.created_at | ddmmyyyyhhmmss }}</div>
                                </div>
                            </li>
                            <li v-if="venta.factura && venta.factura.aprobado_by">
                                <div class="invoices-cambios__item">
                                    <div>Aprobó</div>
                                    <div>@{{ venta.factura.aprobador }}</div>
                                    <div>@{{ venta.factura.aprobado_at  | ddmmyyyyhhmmss}}</div>
                                </div>
                            </li>
                            <li v-if="venta.factura && venta.factura.pagado_by">
                                <div class="invoices-cambios__item">
                                    <div>Pagó</div>
                                    <div> @{{ venta.factura.pagador }}</div>
                                    <div>@{{ venta.factura.pagado_at | ddmmyyyyhhmmss}}</div>
                                </div>
                            </li>
                            <li v-if="venta.factura && venta.factura.updated_by">
                                <div class="invoices-cambios__item">
                                    <div>Actualizó</div>
                                    <div> @{{ venta.factura.updator }}</div>
                                    <div>@{{ venta.factura.updated_at | ddmmyyyyhhmmss}}</div>
                                </div>
                            </li>
                            <li>
                                <div class="invoices-cambios__item">
                                    <div>Identificadores BD:</div>
                                    <div>Venta id: @{{ venta.id }}</div>
                                    <div v-if="venta.factura">factura id: @{{ venta.factura.id }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
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
                        
                    </a>
                    @permission('eliminar_factura')
                    <a  
                        href="javascript:void(0);" 
                        class="btn btn-default" 
                        title="ELiminar factura"
                        @click="eliminarFactura()"
                        v-if="modo === 'Editar Factura'"
                    >
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                    @endpermission
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
                            <label for="estado">Estado *</label>
                            <select
                                class="form-control"
                                v-model="factura.estado"
                            >
                                <option
                                    v-for="estado in $store.state.insumos.estados"
                                    :value="estado"
                                    :disabled="!showEstado"
                                >
                                    @{{ estado }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="expedido a">Expedido a *</label>
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
                            <label for="proveedor">Proveedor *</label>
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
                            <label for="fecha de expedición">Fecha de expedición *</label>
                            <input 
                                onkeydown="return false"
                                type="date"
                                class="form-control"
                                v-model="factura.fecha_exp"
                            >
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-3 form-group">
                            <label for="numero de factura">Número de factura *</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="factura.num_fact"
                            >
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="costo">Costo *</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="factura.costo"
                            >
                            <span class="help-block" v-if="factura.costo > 0">
                                $ @{{ factura.costo | formatPrice }}
                            </span>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="iva">IVA</label>
                            <input
                                type="decimal"
                                class="form-control"
                                v-model="factura.iva"
                            >
                            <span class="help-block" v-if="factura.iva > 0">
                                $ @{{ factura.iva | formatPrice }}
                            </span>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="otros pagos">Otros</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="factura.otros"
                            >
                            <span class="help-block" v-if="factura.otros > 0">
                                $ @{{ factura.otros | formatPrice }}
                            </span>
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

                    <div class="row col-md-12" style="text-align: right;">
                        <p class="help-block">Los campos con asterisco (*) son obligatorios</p>
                    </div>

                    <div class="row col-md-12" v-if="showSubmit">
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

@include('filters')

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
            estado: '',
            modo: "",
            factura: "",
            showEstado: false,
            showSubmit: false,
            permisoCrear: {!! json_encode(Auth::user()->can('crear_factura')) !!},
            permisoEditarProceso: {!! json_encode(Auth::user()->can('editar_factura_proceso')) !!},
            permisoEditarAprobar: {!! json_encode(Auth::user()->can('editar_factura_aprobar')) !!},
            permisoEditarTotal: {!! json_encode(Auth::user()->can('editar_factura_total')) !!},
        }),
        methods: {
            onSubmit() {
                if (this.modo === 'Crear Factura') this.store();
                else if (this.modo === 'Editar Factura') this.update();
                else alertify.alert("Error", "Opción no valida.");
            },
            store() {
                axios.post('/api/facturacion/store', this.factura,{
                        headers: { Authorization: "Bearer " + "{{ session('accessToken') }}" }
                    })
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
                axios.post('/api/facturacion/update', this.factura, {
                        headers: { Authorization: "Bearer " + "{{ session('accessToken') }}" }
                    })
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
                const self = this;
                alertify.confirm(
                    "Confirmar", 
                    "¿Esta seguro de eliminar la factura?", 
                    function () {
                        window.location.href = 
                            "{{ url('/start/facturacion/destroy') }}/" + self.factura.id;
                    },
                    function () {}
                );
            },
            configurarPermisos() {
                if (this.modo === 'Crear Factura') {
                    if (this.permisoCrear) this.setPermisos(false, true);
                    else this.setPermisos(false, false);
                } 
                else if (this.modo === 'Editar Factura') {
                    if (this.permisoEditarTotal) {
                        this.setPermisos(true, true);
                    }
                    else if (this.permisoEditarAprobar) {
                        if (this.factura.estado !== 'Pagado') {
                            this.setPermisos(true, true);
                        } else {
                            this.setPermisos(false, false);
                        }
                    }
                    else if (this.permisoEditarProceso) {
                        if (this.factura.estado === 'En proceso') {
                            this.setPermisos(false, true);
                        } else {
                            this.setPermisos(false, false);
                        }
                    } 
                    else {
                        this.setPermisos(false, false);
                    }
                }
            },
            setPermisos(estado, submit) {
                this.showEstado = estado;
                this.showSubmit = submit;
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
                this.estado = JSON.parse(JSON.stringify(this.factura.estado));
            } else {
                this.modo = "Consultar venta";
            }

            this.configurarPermisos();
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
    .panel-title {
        display: flex;
        justify-content: space-between;
        
    }
    .panel-title__producto {
        display: inline;
    }
    .invoices-cambios {
        font-size: 1.2rem;
        color: #7e7e7e;
    }
    .invoices-cambios__item {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        gap: 1rem;
    }
</style>
