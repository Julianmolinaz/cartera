<script type="text/x-template" id="main-template">
    <div class="panel panel-default" id="myabs">
        <div class="panel-title">
            <h1>
                <span class="glyphicon glyphicon-briefcase" aria-hidden="true" style="color:gray;"></span>
                <span 
                    v-text="
                        ($store.state.modo === 'Editar Solicitud') ? $store.state.modo + ' ' + $store.state.solicitud.id : 
                        ($store.state.modo === 'Editar Credito') ? $store.state.modo + ' ' + $store.state.credito.id : $store.state.modo
                    "
                ></span> 
            </h1>
            <a  class="btn btn-default" :href="rutaSalida">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                Salir
            </a>
        </div>
        
        <div>
            <ul class="tabs">
                <li 
                    :class="['tab-item', view === 'producto' ? 'tab-item--active' : '']"
                    @click="go('producto')"
                >
                    <span>
                        <i class="fa fa-cube tab-item__icon" aria-hidden="true"></i>Producto
                    </span>
                </li>
                <li 
                    :class="['tab-item', view === 'solicitud' ? 'tab-item--active' : '']" 
                    @click="go('solicitud')"
                >
                    <span>
                        <i class="fa fa-plug tab-item__icon" aria-hidden="true"></i>Solicitud
                    </span>
                </li>
                <li 
                    :class="['tab-item', showTabCredito ? '' : 'tab-item--inactive', view === 'credito' ? 'tab-item--active' : '']" 
                    @click="go('credito')"
                >
                    <span>
                        <i class="fa fa-rss-square tab-item__icon" aria-hidden="true"></i>Crédito
                    </span>
                </li>
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content">
                <div v-show="view === 'producto'">
                    <ventas-component />
                </div>      
                <div id="solicitud" v-show="view === 'solicitud'">
                    <solicitud-component />
                </div>
                <div v-show="view === 'credito'">
                    <credito-component />
                </div>
            </div>
            <div class="tab-footer">
                <center>
                    <button class="btn btn-primary" @click="onSubmit">Salvar</button>
                </center>
                <p class="help-block">Los campos con asterisco (*) son obligatorios</p>                
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component("main-component", {
        template: "#main-template",
        data() {
            return {
                view: 'producto',
                showTabCredito: false,
                contVehiculos: 0,
            }
        },
        computed: {
            rutaSalida() {
                return this.$store.getters.getRutaSalida;
            }
        },
        methods: {
            go(view) {
                this.$store.commit("setPermitirContinuar", true);

                switch (this.view) {
                    case "producto":
                        this.validarVentas();
                        break;
                    case "solicitud":
                        this.validarSolicitud();
                        break;
                    case "credito":
                        this.validarCredito();
                        break;
                    default:
                        break;
                }

                setTimeout(() => {
                    if (this.$store.state.permitirContinuar) {
                        Bus.$emit('assign_' + this.view);
                        this.view = view;
                    }
                }, 300);
            },
            showTabCredito_() {
                if  (
                    this.$store.state.modo !== 'Crear Solicitud' &&
                    this.$store.state.modo !== 'Editar Solicitud' &&
                    this.$store.state.modo !== 'Refinanciar Credito'
                ) {
                    this.showTabCredito = true;
                } else {
                    this.showTabCredito = false;
                }
            },
            async validarVentas() {
                if (this.noExistenProductos()) {
                    alertify.notify("Debe agregar por lo menos un producto", "error", 2);
                }
                
                let errorEnPrecios = await this.errorEnPrecios();

                if (errorEnPrecios) {
                    this.$store.commit("setPermitirContinuar", false);
                    alertify.alert("Error", errorEnPrecios);
                }

                this.validarVehiculos();
            },
            validarVehiculos() {
                Bus.$emit("VALIDAR_VEHICULO");
            },
            validarSolicitud() {
                Bus.$emit("VALIDAR_SOLICITUD");
            },
            validarCredito() {
                Bus.$emit("VALIDAR_CREDITO");
            },
            noExistenProductos() {
                return this.$store.getters.getCantidadProductos < 1;
            },
            async errorEnPrecios() {
                return await this.$store.dispatch("validarValorVentas");
            },
            async onSubmit() {
                // Reset errores
                this.$store.state.errores = "";

                // Validar existencia de productos
                if (this.noExistenProductos()) {
                    this.$store.state.permitirSalvar = false;
                    this.$store.state.errores += "Debe agregar por lo menos un producto<br>";
                }

                // Validar precio de productos completos
                let errorEnPrecios = await this.errorEnPrecios();
                if (errorEnPrecios) this.$store.state.errores += errorEnPrecios;

                // -----
                this.validarVehiculos();

                setTimeout(() => {
                    // ------
                    this.validarSolicitud();

                    if (this.$store.state.modo === 'Editar Credito') {
                        setTimeout(() => {
                            // ------
                            this.validarCredito();
                        }, 200);
                    }

                    // Retornar errores si existen
                    setTimeout(() => {
                        if (this.$store.state.errores !== "") {
                            alertify.alert("Error", this.$store.state.errores);
                        } else {
                            this.$store.dispatch("onSubmit");
                        }
                    }, 300);
                }, 200);
            }
        },
        created() {
            this.showTabCredito_();
            
            Bus.$on("VEHICULO_VALIDADO", (response) => {
                if (!response) {
                    this.$store.commit("setPermitirContinuar", false);
                }
                this.contVehiculos ++;
            });
        }
    });
</script>
<style scoped>
    .panel-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 3rem;
    }
    .panel-title h1 {
        margin: 2rem 0;
    }
    .tabs {
       display: flex;
       list-style: none;
       border-bottom: 1px solid #dddddd;
       margin-bottom: 2.4rem;
    }
    .tab-item {
        padding: 1.5rem;
        cursor: pointer;
        border-radius: 4px 4px 0 0;
    }
    .tab-item:hover {
        background-color: #f2f2f2;
    }
    .tab-item span {
        color: #737373;
    }
    .tab-item__icon {
        margin-right: 5px;
    }
    .tab-item--active span {
        color: #4786be;
    }
    .tab-item--inactive {
        display: none;
    }
    .tab-footer {
        padding: 2rem 3rem;
    }
    @media (max-width: 500px) {
        .btn-salir {
            float: none;
        }
    }
</style>