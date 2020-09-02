<script type="text/x-template" id="credito-template">
    
    <div>
        <form @submit.prevent="onSubmit">
            <div class="row">
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.estado.name) ? 'has-error' :'']">
                    <label for="">Estado @{{ rules.estado.required }}</label>
                    <select 
                        type="text" 
                        class="form-control"  
                        v-model="credito.estado"
                        v-validate="rules.estado.rule"
                        :name="rules.estado.name">                              
                        <option selected disabled>--</option>
                        <option :value="i" v-for="i in ['mora',2,3]">@{{i}}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.estado.name) }}</span>
                </div> 
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_credito.name) ? 'has-error' :'']">
                    <label for="">Valor Credito @{{ rules.valor_credito.required }}</label>
                    <input 
                        type="text" 
                        class="form-control"  
                        v-model="credito.valor_credito"
                        v-validate="rules.valor_credito.rule"
                        :name="rules.valor_credito.name"> 
                    <span class="help-block">@{{ errors.first(rules.valor_credito.name) }}</span>
                </div>         
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.saldo.name) ? 'has-error' :'']">
                    <label for="">Saldo @{{ rules.saldo.required }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.saldo"
                        v-validate="rules.saldo.rule"
                        :name="rules.saldo.name"> 
                    <span class="help-block">@{{ errors.first(rules.saldo.name) }}</span>
                </div>  
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.cuotas_faltantes.name) ? 'has-error' :'']">
                    <label for="">Cuotas Faltantes @{{ rules.cuotas_faltantes.required }}</label>    
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.cuotas_faltantes"
                        v-validate="rules.cuotas_faltantes.rule"
                        :name="rules.cuotas_faltantes.name"> 
                    <span class="help-block">@{{ errors.first(rules.cuotas_faltantes.name) }}</span>      
                </div>
            </div> <!-- row file 1 -->
            <div class="row">
            <div v-bind:class="['form-group','col-md-3',errors.first(rules.rendimiento.name) ? 'has-error' :'']">
                    <label for="">Rendimiento @{{ rules.rendimiento.required }}</label>       
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.rendimiento"
                        v-validate="rules.rendimiento.rule"
                        :name="rules.rendimiento.name"> 
                    <span class="help-block">@{{ errors.first(rules.rendimiento.name) }}</span>         
                </div>
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.saldo_favor.name) ? 'has-error' :'']">
                    <label for="">Saldo a Favor @{{ rules.saldo_favor.required }}</label>     
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.saldo_favor"
                        v-validate="rules.saldo_favor.rule"
                        :name="rules.saldo_favor.name"> 
                    <span class="help-block">@{{ errors.first(rules.saldo_favor.name) }}</span>         
                </div>
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.castigada.name) ? 'has-error' :'']">
                    <label for="">Castigada @{{ rules.castigada.required }}</label>    
                    <select 
                        type="text" 
                        class="form-control" 
                        v-model="credito.castigada"
                        v-validate="rules.castigada.rule"
                        :name="rules.castigada.name">
                        <option selected disabled>--</option>
                        <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>
                    </select>  
                    <span class="help-block">@{{ errors.first(rules.castigada.name) }}</span>   
                </div>
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.mes.name) ? 'has-error' :'']">
                    <label for="">Mes @{{ rules.mes.required }}</label>    
                    <select 
                        type="text" 
                        class="form-control"  
                        v-model="credito.mes"
                        v-validate="rules.mes.rule"
                        :name="rules.mes.name">
                        <option selected disabled>--</option>
                        <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.mes.name) }}</span>
                </div>  
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.anio.name) ? 'has-error' :'']">
                    <label for="">Año @{{ rules.anio.required }}</label> 
                    <select 
                        type="text" 
                        class="form-control" 
                        v-model="credito.anio"
                        v-validate="rules.anio.rule"
                        :name="rules.anio.name">
                        <option selected disabled>--</option>
                        <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>
                    </select>  
                    <span class="help-block">@{{ errors.first(rules.anio.name) }}</span>     
                </div> 
            </div> <!-- row file 2 -->
            <div class="row">
            <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                    <label for="">Observaciones @{{ rules.observaciones.required }}</label>
                    <textarea 
                        class="form-control" 
                        v-model="credito.observaciones"
                        v-validate="rules.observaciones.rule"
                        :name="rules.observaciones.name">
                    </textarea>
                <span class="help-block">@{{ errors.first(rules.observaciones.name) }}</span>
            </div>
            </div><!-- row file 3-->
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <!-- <a class="btn btn-default">Volver</a> -->
                        <button class="btn btn-primary">salvar</button>
                    </center>
                </div>
            </div> 
        </form>        
    </div> <!-- div fin -->
</script>
    
<script src="/js/interfaces/credito.js"></script>
<script src="/js/rules/credito.js"></script>

<script>

    const credito = Vue.component('credito-component',{
        template: '#credito-template',
        data() {
            return {
                credito: new Credito(),
                rules: rules_credito
            }
        },
        methods: {
            async onSubmit() {
                let valid = await this.$validator.validate()
            }
        }
    });

</script>




