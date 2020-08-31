<script type="text/x-template" id="solicitud-template">
    
<div>
    <form @submit.prevent="onSubmit">
        <div class="row">
            <!-- FECHA SOLICITUD  -->

            <div v-bind:class="['form-group','col-md-4',errors.first(rules.fecha_solicitud.name) ? 'has-error' :'']">
                <label for="">Fecha @{{ rules.fecha_solicitud.required }}</label>    
                <input 
                    type="date" 
                    class="form-control" 
                    v-model="solicitud.fecha"
                    v-validate="rules.fecha_solicitud.rule"
                    :name="rules.fecha_solicitud.name">  
                <span class="help-block">@{{ errors.first(rules.fecha_solicitud.name) }}</span>                   
            </div>

            <!-- CARTERA  -->

            <div v-bind:class="['form-group','col-md-4',errors.first(rules.cartera.name) ? 'has-error' :'']">
                <label for="">Cartera @{{ rules.cartera.required }}</label> 
                <select 
                    class="form-control" 
                    v-validate="rules.cartera.rule"
                    :name="rules.cartera.name"
                    v-model="solicitud.cartera_id"> 
                    <option selected disabled>--</option>
                    <option :value="cartera.id" v-for="cartera in data.carteras">@{{cartera.nombre}}</option>                
                </select>
                <span class="help-block">@{{ errors.first(rules.cartera.name) }}</span>                   
            </div>

            <!-- APROBADO  -->

            <div v-bind:class="['form-group','col-md-4',errors.first(rules.aprobado.name) ? 'has-error' :'']">
                <label for="">Aprobado @{{ rules.aprobado.required }}</label>
                <select 
                    class="form-control" 
                    v-model="solicitud.aprobado"
                    v-validate="rules.aprobado.rule"
                    :name="rules.aprobado.name"> 
                    <option selected disabled>--</option>
                    <option :disabled="$store.state.data.status == 'create'"
                        :value="estado" 
                        v-for="estado in data.estados_aprobacion">
                        @{{estado}}
                    </option>  
                </select>
                <span class="help-block">@{{ errors.first(rules.aprobado.name) }}</span>                   
            </div>    
        </div> <!-- row file 1  -->
        <div class="row">

            <!-- CENTRO DE COSTOS -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.centro_costo.name) ? 'has-error' :'']">
                <label for="">Centro de Costos @{{ rules.centro_costo.required }}</label>
                <input 
                    @keyup="validar_negocio"
                    type="text" 
                    class="form-control"  
                    placeholder="Monto Solicitado"
                    v-model="solicitud.vlr_fin"
                    v-validate="rules.centro_costo.rule"
                    :name="rules.centro_costo.name">
                <span class="help-block">@{{ errors.first(rules.centro_costo.name) }}</span>                   
            </div>

            <!-- CUOTA INICIAL -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.cuota_inicial.name) ? 'has-error' :'']">
                <label for="">Cuota Inicial @{{ rules.cuota_inicial.required }}</label>
                <input
                    type="text" 
                    class="form-control" 
                    placeholder="Monto inicial"
                    v-model="solicitud.cuota_inicial"
                    v-validate="rules.cuota_inicial.rule"
                    :name="rules.cuota_inicial.name">
                <span class="help-block">@{{ errors.first(rules.cuota_inicial.name) }}</span>
            </div>

            <!-- PERIODO -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.periodo.name) ? 'has-error' :'']">
                <label for="">Periodo @{{ rules.periodo.required }}</label>
                <select 
                    @change="setPeriodo"
                    class="form-control"  
                    v-model="solicitud.periodo"
                    v-validate="rules.periodo.rule"
                    :name="rules.periodo.name">
                    <option selected disabled>--</option>
                    <option :value="periodo" v-for="periodo in data.arr_periodos">@{{ periodo }}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.periodo.name) }}</span>
            </div>

            <!-- NUMERO DE CUOTAS -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.num_cuotas.name) ? 'has-error' :'']">
                <label for="">Número de Cuotas @{{ rules.num_cuotas.required }}</label>
                <input 
                    @keyup="validar_negocio"
                    type="text" 
                    class="form-control" 
                    placeholder="Cantidad de Cuotas"
                    v-model="solicitud.cuotas"
                    v-validate="rules.num_cuotas.rule"
                    :name="rules.num_cuotas.name">
                <span class="help-block">@{{ errors.first(rules.num_cuotas.name) }}</span>
            </div>
        </div> <!-- row file 2-->
        <div class="row">

            <!-- VALOR CUOTAS  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_cuotas.name) ? 'has-error' :'']">
                <label for="">Valor Cuotas @{{ rules.valor_cuotas.required }}</label>
                <input 
                    @keyup="validar_negocio"
                    type="text" 
                    class="form-control"  
                    placeholder="valor cuotas"
                    v-model="solicitud.vlr_cuota"
                    v-validate="rules.valor_cuotas.rule"
                    :name="rules.valor_cuotas.name">
                <span class="help-block">@{{ errors.first(rules.valor_cuotas.name) }}</span>
            </div>

            <!-- FECHA DE PAGO 1 -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_1.name) ? 'has-error' :'']">
                <label for="">F. Pago 1 @{{ rules.f_pago_1.required }}</label>
                <select 
                    @change="setRango2"
                    class="form-control" 
                    v-model="solicitud.p_fecha"
                    v-validate="rules.f_pago_1.rule"
                    :name="rules.f_pago_1.name">
                    <option selected disabled></option>
                    <option :value="i" v-for="i in rango1">@{{ i }}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.f_pago_1.name) }}</span>
            </div>

            <!-- FECHA DE PAGO 2  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_2.name) ? 'has-error' :'']">
                <label for="">F. Pago 2 @{{ rules.f_pago_2.required }}</label>
                <select
                    :disabled="solicitud.periodo == 'Mensual'"
                    class="form-control"  
                    v-model="solicitud.s_fecha"
                    v-validate="rules.f_pago_2.rule"
                    :name="rules.f_pago_2.name">
                    <option selected disabled>--</option>
                    <option :value="i" v-for="i in rango2" >@{{ i }}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.f_pago_2.name) }}</span>
            </div>

            <!-- ESTUDIO  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.estudio.name) ? 'has-error' :'']">
                <label for="">Estudio @{{ rules.estudio.required }}</label>
                <select 
                    class="form-control"  
                    placeholder="Tipo de Estudio"
                    v-model="solicitud.estudio"
                    v-validate="rules.estudio.rule"
                    :name="rules.estudio.name">
                    <option selected disabled>--</option>
                    <option :value="tipo" v-for="tipo in data.arr_estudios">@{{tipo}}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.estudio.name) }}</span>

            </div>
        </div><!-- row file 3-->    
        <div class="row">

            <!-- OBSERVACIONES  -->

            <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                <label for="">Observaciones @{{ rules.observaciones.required }}</label>
                    <textarea 
                        class="form-control" 
                        v-model="solicitud.observaciones"
                        v-validate="rules.observaciones.rule"
                        :name="rules.observaciones.name">
                    </textarea>
                <span class="help-block">@{{ errors.first(rules.observaciones.name) }}</span>
            </div>
        </div><!-- row file 4-->
        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <a class="btn btn-default" @click="volver">Volver</a>
                    <button class="btn btn-primary">Continuar</button>
                </center>
            </div>
        </div> 
    </form>
</div> <!-- div pripal -->
</script>


<script src="/js/rules/solicitud.js"></script>
<script src="/js/interfaces/solicitud.js"></script>
<script>

    const solicitud = Vue.component('solicitud-component',{
        template: '#solicitud-template',
        data() {
            return {
                rango1: [],
                rango2: [],
                data: this.$store.state.data,
                solicitud: this.$store.state.solicitud,
                rules: rules_solicitud
            }
        },
        methods: {
            volver () {
                $('.nav-tabs a[href="#producto"]').tab('show') 
                
            },
            continuar () {
                $('.nav-tabs a[href="#credito"]').tab('show') 
            },
            async onSubmit() {
                if ( ! await this.$validator.validate() ) {
                    alert('Por favor complete los campos');
                    return false;
                }
                
                let res = await axios.post('/start/precreditos', {
                    'elements'  : this.$store.state.elements,
                    'solicitud' : this.$store.state.solicitud
                })

                alert(res.data.message);

                if (res.data.success) {
                    window.location.href = "{{url('/start/clientes')}}/"+res.data.dat.cliente_id;
                }
            },            
            async validarForm() {
                let valid = await this.$validator.validate();
                return valid
            },
            validar_negocio() {

                if (   this.solicitud.vlr_fin 
                    && this.solicitud.cuotas 
                    && this.solicitud.vlr_cuota) {

                    const sumatoria = this.solicitud.cuotas *  this.solicitud.vlr_cuota;

                    if ( sumatoria <= (this.solicitud.vlr_fin * 1)) {
                        // alertify.notify('La sumatoria de cuotas no coincide con el valor del centro de costos', 'error', 5)
                    } else {
                        alertify.notify('El resultado es válido', 'success', 10)
                    }
                }
            },
            setPeriodo(){
                

                if (this.solicitud.periodo == 'Quincenal') {
                    this.rango1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
                } else {
                    this.rango2 = []
                    this.rango1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                }

                if (this.solicitud.p_fecha) this.setRango2()
            },
            setRango2(){
                if (this.solicitud.periodo == 'Quincenal') {
                    let n = this.solicitud.p_fecha
                    this.rango2 = [n+15, n+16, n+17]
                    alertify.notify('Escoja una segunda fecha', 'success', 5)
                } else {
                    this.rango2 = []
                }
            }
         
        },   
        created() {
            console.log(this.$store.state.data.cliente.id)

           if (this.$store.state.data.status == 'create') {
               this.solicitud.cliente_id = this.$store.state.data.cliente.id
           } 
        }
    });

</script>

