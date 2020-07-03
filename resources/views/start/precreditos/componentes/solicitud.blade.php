<script type="text/x-template" id="solicitud-template">
    
<div>
    <form @submit.prevent="onSubmit">
        <div class="row">
            <div v-bind:class="['form-group','col-md-4',errors.first(rules.fecha_solicitud.name) ? 'has-error' :'']">
                <label for="">Fecha @{{ rules.fecha_solicitud.required }}</label>    
                <input 
                    type="date" 
                    class="form-control" 
                    v-model="solicitud.fecha_solicitud"
                    v-validate="rules.fecha_solicitud.rule"
                    :name="rules.fecha_solicitud.name">  
                <span class="help-block">@{{ errors.first(rules.fecha_solicitud.name) }}</span>                   
            </div>
            <div v-bind:class="['form-group','col-md-4',errors.first(rules.cartera.name) ? 'has-error' :'']">
                <label for="">Cartera @{{ rules.cartera.required }}</label> 
                <select 
                    type="text" 
                    class="form-control" 
                    placeholder="Escoja Cartera"
                    v-model="solicitud.cartera"
                    v-validate="rules.cartera.rule"
                    :name="rules.cartera.name"> 
                    <option selected disabled>--</option>
                    <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>                
                </select>
                <span class="help-block">@{{ errors.first(rules.cartera.name) }}</span>                   
            </div>
            <div v-bind:class="['form-group','col-md-4',errors.first(rules.aprobado.name) ? 'has-error' :'']">
                <label for="">Aprobado @{{ rules.aprobado.required }}</label>
                <select 
                    class="form-control" 
                    v-model="solicitud.aprobado"
                    v-validate="rules.aprobado.rule"
                    :name="rules.aprobado.name"> 
                    <option selected disabled>--</option>
                    <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>  
                </select>
                <span class="help-block">@{{ errors.first(rules.aprobado.name) }}</span>                   
            </div>    
        </div> <!-- row file 1  -->
        <div class="row">
        <div v-bind:class="['form-group','col-md-3',errors.first(rules.centro_costo.name) ? 'has-error' :'']">
                <label for="">Centro de Costos @{{ rules.centro_costo.required }}</label>
                <input 
                    type="text" 
                    class="form-control"  
                    placeholder="Monto Solicitado"
                    v-model="solicitud.centro_costo"
                    v-validate="rules.centro_costo.rule"
                    :name="rules.centro_costo.name">
                <span class="help-block">@{{ errors.first(rules.centro_costo.name) }}</span>                   
            </div>
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
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.periodo.name) ? 'has-error' :'']">
                <label for="">Periodo @{{ rules.periodo.required }}</label>
                <select 
                    class="form-control"  
                    v-model="solicitud.periodo"
                    v-validate="rules.periodo.rule"
                    :name="rules.periodo.name">
                    <option selected disabled>--</option>
                    <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.periodo.name) }}</span>
            </div>
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.num_cuotas.name) ? 'has-error' :'']">
                <label for="">Num de Cuotas @{{ rules.num_cuotas.required }}</label>
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Cantidad de Cuotas"
                    v-model="solicitud.num_cuotas"
                    v-validate="rules.num_cuotas.rule"
                    :name="rules.num_cuotas.name">
                <span class="help-block">@{{ errors.first(rules.num_cuotas.name) }}</span>
            </div>
        </div> <!-- row file 2-->
        <div class="row">
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_cuotas.name) ? 'has-error' :'']">
                <label for="">Valor Cuotas @{{ rules.valor_cuotas.required }}</label>
                <input 
                    type="text" 
                    class="form-control"  
                    placeholder="ingrese Cuotas"
                    v-model="solicitud.valor_cuotas"
                    v-validate="rules.valor_cuotas.rule"
                    :name="rules.valor_cuotas.name">
                <span class="help-block">@{{ errors.first(rules.valor_cuotas.name) }}</span>
            </div>
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_1.name) ? 'has-error' :'']">
                <label for="">F. Pago 1 @{{ rules.f_pago_1.required }}</label>
                <input 
                    type="date" 
                    class="form-control" 
                    v-model="solicitud.f_pago_1"
                    v-validate="rules.f_pago_1.rule"
                    :name="rules.f_pago_1.name">
                <span class="help-block">@{{ errors.first(rules.f_pago_1.name) }}</span>
            </div>
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_2.name) ? 'has-error' :'']">
                <label for="">F. Pago 2 @{{ rules.f_pago_2.required }}</label>
                <input 
                    type="date" 
                    class="form-control"  
                    v-model="solicitud.f_pago_2"
                    v-validate="rules.f_pago_2.rule"
                    :name="rules.f_pago_2.name">
                <span class="help-block">@{{ errors.first(rules.f_pago_2.name) }}</span>
            </div>
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.estudio.name) ? 'has-error' :'']">
                <label for="">Estudio @{{ rules.estudio.required }}</label>
                <select 
                    class="form-control"  
                    placeholder="Tipo de Estudio"
                    v-model="solicitud.valor_cuotas"
                    v-validate="rules.estudio.rule"
                    :name="rules.estudio.name">
                    <option selected disabled>--</option>
                    <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.estudio.name) }}</span>

            </div>
        </div><!-- row file 3-->    
        <div class="row">
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
                    <a class="btn btn-default">Volver</a>
                    <button class="btn btn-primary">Continuar</button>
                </center>
            </div>
        </div> 
    </form>
</div> <!-- div pripal -->
</script>

<script src="/js/interfaces/solicitud.js"></script>
<script src="/js/rules/solicitud.js"></script>

<script>

    const solicitud = Vue.component('solicitud-component',{
        template: '#solicitud-template',
        data() {
            return {
                solicitud: new Solicitud(),
                rules: rules_solicitud
            }
        },
        methods: {
            async onSubmit() {
                let valid = await this.$validator.validate()

                // imprimir por consola
                console.log(valid)
            }
        }
    });

</script>

