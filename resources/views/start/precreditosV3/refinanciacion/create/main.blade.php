<script type="text/x-template" id="main-template">
    <div class="panel panel-default ref-container">
        <div class="panel-title ref-title-container">
            <div class="ref-title">
                <i class="fa fa-reply-all ref-title__icon" aria-hidden="true"></i>
                <h1>Refinanciar</h1>
            </div>
            <div class="ref-salir">
                <a  class="btn btn-default" href="">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Salir
                </a>
            </div>
        </div>
        <div class="panel-body ref-body">
            <form @submit.prevent>
                <!-- APROBADO -->
                <div class="col-md-2 col-sm-4 form-group">
                    <label for="aprobado">Aprobado</label>
                    <select class="form-control" name="aprobado" v-model="solicitud.aprobado" disabled>
                        <option :value="item" v-for="item in insumos.insumosSolicitud.estados_aprobacion">
                            @{{ item }}
                        </option>
                    </select>
                </div>
                <!-- CONSECUTIVO -->
                <div class="col-md-2 col-sm-4 form-group">
                    <label for="consecutivo">Consecutivo</label>
                    <input type="text" name="consecutivo" class="form-control" v-model="solicitud.num_fact" disabled>
                </div>
                <!-- FECHA -->
                <div class="col-md-2 col-sm-4 form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="form-control" v-model="solicitud.fecha">
                </div>
                <!-- CARTERA -->
                <div class="col-md-3 col-sm-6 form-group">
                    <label for="cartera">Cartera</label>
                    <select name="cartera" class="form-control" v-model="solicitud.cartera_id">
                        <option :value="cartera.id" v-for="cartera in insumos.insumosSolicitud.carteras">
                            @{{ cartera.nombre }}
                        </option>
                    </select>
                </div>
                <!-- VENDEDOR -->
                <div class="col-md-3 col-sm-6 form-group">
                    <label for="vendedor">Vendedor</label>
                    <select name="vendedor" class="form-control" v-model="solicitud.funcionario_id">
                        <option :value="vendedor.id" v-for="vendedor in insumos.insumosSolicitud.vendedores">
                            @{{ vendedor.name }}
                        </option>
                    </select>
                    
                </div>
                <!-- COSTO DEL CREDITO -->
                <div class="col-md-4 col-sm-4 form-group">
                    <label for="costo del credito" class="lbl-recomendado">
                        <span>Costo del crédito</span>
                        <span class="recomendado">recomendado: @{{ creditoPadre.saldo }}</span>
                    </label>
                    <input type="text" name="costo del credito" class="form-control" v-model="solicitud.vlr_fin" v-validate="'required'">
                    <span class="help-block">@{{ errors.first("costo del credito") }}</span>
                </div>
                <!-- CUOTA INICIAL -->
                <div class="col-md-2 col-sm-4 form-group">
                    <label for="cuota inicial">Cuota inicial</label>
                    <input type="text" name="cuota inicial" class="form-control" v-model="solicitud.cuota_inicial" v-validate="'required'">
                    <span class="help-block">@{{ errors.first("cuota inicial") }}</span>
                </div>
                <!-- MESES -->
                <div class="col-md-2 col-sm-4 form-group">
                    <label for="meses">Meses</label>
                    <select name="meses" class="form-control" v-model="solicitud.meses" v-validate="'required'">
                        <option :value="mes" v-for="mes in insumos.insumosSolicitud.rango_meses">
                            @{{ mes }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first("meses") }}</span>
                </div>
                <!-- PERIODO -->
                <div class="col-md-2 col-sm-4 form-group">
                    <label for="periodo">Periodo</label>
                    <select name="periodo" class="form-control" v-model="solicitud.periodo" v-validate="'required'">
                        <option :value="periodo" v-for="periodo in insumos.insumosSolicitud.arr_periodos">
                            @{{ periodo }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first("periodo") }}</span>
                </div>
                <!-- NUM CUOTAS -->
                <div class="col-md-2 col-sm-4 form-group">
                    <label for="numero de cuotas">Num cuotas</label>
                    <input type="text" class="form-control" v-model="solicitud.num_cuotas">
                </div>
                <!-- VALOR CUOTA -->
                <div class="col-md-3 col-sm-4 form-group">
                    <label for="valor cuota">Valor cuota</label>
                    <input type="text" name="valor cuota" class="form-control" v-model="solicitud.vlr_cuota" v-validate="'required'">
                    <span class="help-block">@{{ errors.first("valor cuota") }}</span>
                </div>
                <!-- FECHA 1 -->
                <div class="col-md-3 col-sm-4 form-group">
                    <label for="fecha de pago uno">Fecha 1</label>
                    <select name="fecha 1" class="form-control" v-model="solicitud.p_fecha" v-validate="'required'">
                        <option value=""></option>
                    </select>
                    <span class="help-block">@{{ errors.first("fecha 1") }}</span>
                </div>
                <!-- FECHA 2 -->
                <div class="col-md-3 col-sm-4 form-group">
                    <label for="fecha de pago uno">Fecha 2</label>
                     <select class="form-control" v-model="solicitud.s_fecha">
                        <option value=""></option>
                    </select>
                </div>
                <!-- ESTUDIO -->
                <div class="col-md-3 col-sm-4 form-group">
                    <label for="fecha de pago uno">Estudio</label>
                    <select class="form-control" v-model="solicitud.estudio">
                        <option :value="item" v-for="item in insumos.insumosSolicitud.arr_estudios">
                            @{{ item }}
                        </option>
                    </select>
                </div>
                <!-- OBSERVACIONES -->
                <div class="col-md-12 form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" v-model="solicitud.observaciones"></textarea>
                </div>
                <div class="col-md-12">
                    <center>
                        <button type="submit" class="btn btn-primary" @click="onSubmit">Salvar</button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</script>

<script src="/js/SolicitudV3/Solicitud.js"></script>

<script>

    Vue.use(VeeValidate)
    VeeValidate.Validator.localize("es");

    Vue.component("main-component", {
        template: "#main-template",
        props: ['insumos', 'solicitudPadre', 'creditoPadre'],
        data: () => ({
            solicitud: null,
            now: new Date(Date.now()).toISOString().slice(0, 10),
        }),
        methods: {
            async onSubmit() {
                if (! await this.$validator.validate()) {
                    
                }
            }
        },
        created() {
            this.solicitud = new Solicitud({
                aprobado: "Si",
                num_fact: "R" + this.solicitudPadre.num_fact,
                cartera_id: this.solicitudPadre.cartera_id,
                cliente_id: this.solicitudPadre.cliente_id,
                cuota_inicial: 0,
                estudio: "Sin estudio",
                fecha: this.now,
                funcionario_id: this.solicitudPadre.funcionario_id
            });
        }
    });
</script>
<style scoped>
    .ref-container {
    }
    .ref-title-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #cccccc;
        padding: 1rem 3rem; 
    }
    .ref-title {
        display: flex;
        align-items: center;
        gap: .5rem;
    }
    .ref-title__icon {
        font-size: 2rem;
        color: gray;
    }
    .lbl-recomendado {
        display: flex;
        justify-content: space-between;
    }
    .lbl-recomendado span {
        display: inline;
    }
    .recomendado {
        font-weight: 400;
    }
    .help-block {
        color: red;
    }
</style>