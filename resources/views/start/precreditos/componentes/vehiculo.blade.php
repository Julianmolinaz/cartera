<script type="text/x-template" id="vehiculo-template">
    
<div>

    <div class="row">
        <div class="form-group">
            <button class="btn btn-success" style="margin-left: 15px;">Agregar vehiculo</button>
        </div>
    </div>

    <form @submit.prevent="onSubmit">

        <template v-for="i in $store.state.producto.min_vehiculos">
            <div class="row">
                
                <!-- TIPO  -->

                <div class="form-group">
                    <div v-bind:class="['form-group','col-md-6',errors.first(rules.tipo_vehiculo.name) ? 'has-error' :'']">
                        <label for="">Tipo Vehiculo @{{ rules.tipo_vehiculo.required }}</label>      
                        <select 
                            type="text" 
                            class="form-control"  
                            placeholder="escoja tipo vehiculo"
                            v-model="vehiculo.tipo"
                            v-validate="rules.tipo_vehiculo.rule"                                                                                                                                       
                            :name="rules.tipo_vehiculo.name">  
                            <option selected disabled>--</option>
                            <option :value="i" v-for="tipo in tipos">@{{tipo}}</option>
                        </select> 
                        <span class="help-block">@{{ errors.first(rules.tipo_vehiculo.name) }}</span>         
                    </div>

                    <div v-bind:class="['form-group','col-md-6',errors.first(rules.placa.name) ? 'has-error' :'']">
                        <label for="">Placa @{{ rules.placa.required }}</label>  
                        <input  
                            class="form-control"  
                            placeholder="escriba placa"
                            v-model="vehiculo.placa"
                            v-validate="rules.placa.rule"
                            :name="rules.placa.name"> 
                        <span class="help-block">@{{ errors.first(rules.placa.name) }}</span>                
                    </div>
                </div> 
            </div><!-- row fole 1 -->
            <div class="row">
                <div class="form-group">
                    <div v-bind:class="['form-group','col-md-6',errors.first(rules.soat.name) ? 'has-error' :'']">
                        <label for="">Vencimiento SOAT @{{ rules.soat.required }}</label>  
                        <input 
                            type="date" 
                            class="form-control"  
                            v-model="vehiculo.soat"
                            v-validate="rules.soat.rule"
                            :name="rules.soat.name"> 
                        <span class="help-block">@{{ errors.first(rules.soat.name) }}</span>       
                    </div>
                    <div v-bind:class="['form-group','col-md-6',errors.first(rules.rtm.name) ? 'has-error' :'']">
                        <label for="">Vencimiento RTM @{{ rules.rtm.required }}</label>     
                        <input 
                            type="date" 
                            class="form-control"
                            v-model="vehiculo.rtm"
                            v-validate="rules.rtm.rule"
                            :name="rules.rtm.name"> 
                        <span class="help-block">@{{ errors.first(rules.rtm.name) }}</span>      
                    </div>
                </div>
            </div><!-- row fole 2 -->
            <div class="row">
                <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                    <label for="">Obsercaciones @{{ rules.observaciones.required }}</label> 
                        <textarea 
                            class="form-control" 
                            v-model="vehiculo.observaciones"
                            v-validate="rules.observaciones.rule"
                            :name="rules.observaciones.name"> 
                        </textarea>
                    <span class="help-block">@{{ errors.first(rules.observaciones.name) }}</span>         

                </div>
            </div><!-- row file 3-->
            <hr style="border:2px solid gray;">
        </template>

        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <a class="btn btn-default">Volver</a>
                    <button class="btn btn-primary">Salvar</button>
                </center>
            </div>
        </div> 
    </form>        
</div>
    
</script>



<script>

    const vehiculo = Vue.component('vehiculo-component',{
        template: '#vehiculo-template',
        data() {
            return {
                vehiculo: new Vehiculo(),
                rules: rules_vehiculo,
                tipos: {!! json_encode($tipo_vehiculos) !!}
            }
        },
        methods: {
            async onSubmit() {
                let valid = await this.$validator.validate()

                console.log(this.$store.state.producto.min_vehiculos)

                // imprimir por consola
                console.log(valid)
            }
        }
    });

</script>







