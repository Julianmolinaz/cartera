<script type="text/x-template" id="datos_conyuge-template">

<div class="row">

    <form @submit.prevent="onSubmit">
    
        <div class="col-md-12">

        <div :class="['alert', alert_class]" role="alert" v-if="alert">@{{message}}</div>
                    
            <!-- Primer nombre  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.p_nombrey.name) ? 'has-error' :'']">
                <label>Primer nombre *</label>
                <input type="text" 
                    class="form-control"
                    name="primer nombre"
                    v-model="conyuge.p_nombrey"
                    v-validate="rules.p_nombrey.rule">
                <span class="help-block">@{{ errors.first(rules.p_nombrey.name) }}</span>
            </div>

            <!-- Segundo nombre  -->
            
            <div v-bind:class="['form-group','col-md-3', errors.first(rules.s_nombrey.name) ? 'has-error' :'']">
                <label>Segundo nombre</label>
                <input type="text" class="form-control"
                    name="segundo nombre"
                    v-model="conyuge.s_nombrey"
                    v-validate="rules.s_nombrey.rule">
                <span class="help-block">@{{ errors.first(rules.s_nombrey.name) }}</span>                 
            </div>

            <!-- Primer apellido  -->

            <div v-bind:class="['form-group','col-md-3', errors.first(rules.p_apellidoy.name) ? 'has-error' :'']">
                <label>Primer apellido *</label>
                <input type="text" class="form-control"
                    name="primer apellido"
                    v-model="conyuge.p_apellidoy"
                    v-validate="rules.p_apellidoy.rule">
                <span class="help-block">@{{ errors.first(rules.p_apellidoy.name) }}</span>
            </div>

            <!-- Segundo apellido  -->
            
            <div v-bind:class="['form-group','col-md-3', errors.first(rules.s_apellidoy.name) ? 'has-error' :'']">
                <label>Segundo apellido</label>
                <input type="text" 
                    class="form-control"
                    name="segundo apellido"
                    v-model="conyuge.s_apellidoy"
                    v-validate="rules.s_apellidoy.rule">
                <span class="help-block">@{{ errors.first(rules.s_apellidoy.name) }}</span>
            </div>
        
        </div>

        <div class="col-md-12">

            <!-- Tipo documento  -->

            <div v-bind:class="['form-group','col-md-3', errors.first(rules.tipo_docy.name) ? 'has-error' :'']">
                <label>Tipo de documento</label>
                <select name="tipo documento" 
                    v-model="conyuge.tipo_docy"
                    class="form-control"
                    v-validate="rules.tipo_docy.rule">
                    <option disabled selected>Tipo documento</option>
                    <option :value="tipo_doc" v-for="tipo_doc in data.tipo_doc">@{{tipo_doc}}</option>    
                </select>
                <span class="help-block">@{{ errors.first(rules.tipo_docy.name) }}</span>
            </div>

            <!-- Numero de documento      -->

            <div v-bind:class="['form-group','col-md-3', errors.first(rules.num_docy.name) ? 'has-error' :'']">
                <label>Núm de documento</label>
                <input type="text" class="form-control"
                    name="numero de documento"
                    placeholder="Número de documento"
                    v-model="conyuge.num_docy"
                    v-validate="rules.num_docy.rule">
                <span class="help-block">@{{ errors.first(rules.num_docy.name) }}</span>
            </div>

            <!-- Telefono celular  -->

            <div v-bind:class="['form-group','col-md-3', errors.first(rules.movily.name) ? 'has-error' :'']">
                <label>Celular *</label>
                <input type="text" 
                    class="form-control"
                    name="celular"
                    placeholder="Celular"
                    v-model="conyuge.movily"
                    v-validate="rules.movily.rule">
                <span class="help-block">@{{ errors.first(rules.movily.name) }}</span>
            </div>

            <!-- Telefono fijo/celular  -->

            <div v-bind:class="['form-group','col-md-3', errors.first(rules.fijoy.name) ? 'has-error' :'']">
                <label>Telefono</label>
                <input type="text" 
                    class="form-control"
                    name="telefono"
                    placeholder="teléfono fijo/celular"
                    v-model="conyuge.fijoy"
                    v-validate="rules.fijoy.rule">
                <span class="help-block">@{{ errors.first(rules.fijoy.name) }}</span>
            </div>

        </div>

        <div class="col-md-12">

            <!-- Direccion  -->

            <div v-bind:class="['form-group','col-md-12', errors.first(rules.diry.name) ? 'has-error' :'']">
                <label>Dirección</label>
                <input type="text" 
                    name="direccion" 
                    v-model="conyuge.diry"
                    class="form-control"
                    v-validate="rules.diry.rule">
                <span class="help-block">@{{ errors.first(rules.diry.name) }}</span>
            </div>

        </div>

        <div class="col-md-12" style="margin-top:20px;">
            <center>
                <a class="btn btn-default" v-if="estado == 'creacion'" @click="volver">Volver</a>
                <button class="btn btn-primary">Salvar</button>
            </center>
        </div>
    
    </form>


</div>

</script>

<script src="{{ asset('js/rules/conyuge.js') }}"></script>

<script>

    Vue.component('datos_conyuge-component',{
        template: '#datos_conyuge-template',
        data () {
            return {
                estado  : this.$store.state.estado,
                rules   : rules_conyuge,
                conyuge : this.$store.state.conyuge,
                data    : this.$store.state.data,
                alert   : null,
                alert_class : '',
                message : ''
            }
        },
        methods: {
            volver () {
                $('.nav-tabs a[href="#actividad"]').tab('show') 
            },
            async onSubmit () {

                console.log('submit coyuge');

                let valid = await this.$validator.validate()

                console.log({valid})

                let cliente_id = await this.$store.state.cliente.id

                console.log({cliente_id})

                if (!cliente_id) {
                    this.alert_class = 'alert-warning'
                    this.message = 'Se requiere crear el cliente'
                    this.alert = true
                }

                if (valid) {
                    let res = await axios.post('/start/conyuges',{
                        cliente_id : cliente_id,
                        conyuge    : this.conyuge
                    })

                    console.log({res})

                    if (res.data.success) {
                        if (res.data.message == '') {
                            this.message_danger = true
                            this.message = res.data.dat
                        } else {
                            document.location.href= "/start/clientes/"+this.$store.state.cliente.id
                        }
                    }
                } 
                else {
                    alert('Por favor complete la informacion requerida')
                }
            },
        }

    });

</script>