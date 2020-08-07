<script type="text/x-template" id="datos_personales-template">

    <div class="row">

        <form @submit.prevent="onSubmit">
        
            <div class="col-md-12">

                <div v-if="warning_message" class="alert alert-warning" role="alert" v-text="message"></div>
                
                <!-- Primer nombre  -->

                <div v-bind:class="['form-group','col-md-3',errors.first(rules.primer_nombre.name) ? 'has-error' :'']">
                    <label>Primer nombre *</label>
                    <input type="text" 
                        class="form-control"
                        name="primer nombre"
                        v-model="personal.primer_nombre"
                        v-validate="rules.primer_nombre.rule">
                    <span class="help-block">@{{ errors.first(rules.primer_nombre.name) }}</span>
                </div>

                <!-- Segundo nombre  -->
                
                <div v-bind:class="['form-group','col-md-3', errors.first(rules.segundo_nombre.name) ? 'has-error' :'']">
                    <label>Segundo nombre</label>
                    <input type="text" class="form-control"
                        name="segundo nombre"
                        v-model="personal.segundo_nombre"
                        v-validate="rules.segundo_nombre.rule">
                    <span class="help-block">@{{ errors.first(rules.segundo_nombre.name) }}</span>                 
                </div>

                <!-- Primer apellido  -->

                <div v-bind:class="['form-group','col-md-3', errors.first(rules.primer_apellido.name) ? 'has-error' :'']">
                    <label>Primer apellido *</label>
                    <input type="text" class="form-control"
                        name="primer apellido"
                        v-model="personal.primer_apellido"
                        v-validate="rules.primer_apellido.rule">
                    <span class="help-block">@{{ errors.first(rules.primer_apellido.name) }}</span>
                </div>

                <!-- Segundo apellido  -->
                
                <div v-bind:class="['form-group','col-md-3', errors.first(rules.segundo_apellido.name) ? 'has-error' :'']">
                    <label>Segundo apellido</label>
                    <input type="text" 
                        class="form-control"
                        name="segundo Apellido"
                        v-model="personal.segundo_apellido"
                        v-validate="rules.segundo_apellido.rule">
                    <span class="help-block">@{{ errors.first(rules.segundo_apellido.name) }}</span>
                </div>
            
            </div>

            <div class="col-md-12">

                <!-- Tipo documento  -->

                <div v-bind:class="['form-group','col-md-3', errors.first(rules.tipo_doc.name) ? 'has-error' :'']">
                    <label>Tipo de documento *</label>
                    <select name="tipo de documento" 
                        v-model="personal.tipo_doc"
                        class="form-control"
                        v-validate="rules.tipo_doc.rule">
                        <option disabled selected>Tipo documento</option>
                        <option :value="tipo_doc" v-for="tipo_doc in data.tipo_doc">@{{tipo_doc}}</option>    
                    </select>
                    <span class="help-block">@{{ errors.first(rules.tipo_doc.name) }}</span>
                </div>
        
                <!-- Número de documento -->

                <div v-bind:class="['form-group','col-md-3', errors.first(rules.num_doc.name) ? 'has-error' :'']">
                    <label>Núm de documento *</label>
                    <input type="text" class="form-control"
                        name="numero de documento"
                        placeholder="Número de documento"
                        v-model="personal.num_doc"
                        v-validate="rules.num_doc.rule">
                    <span class="help-block">@{{ errors.first(rules.num_doc.name) }}</span>
                </div>
               
               <!-- Lugar de expedición -->
               
                <div v-bind:class="['form-group','col-md-3', errors.first(rules.lugar_exp.name) ? 'has-error' :'']">
                    <label>Lugar de expedición *</label>
                    <input type="text" class="form-control"
                        name="lugar de expedicion"
                        placeholder="Ciudad donde se expidió el documento"
                        v-model="personal.lugar_exp"
                        v-validate="rules.lugar_exp.rule">
                    <span class="help-block">@{{ errors.first(rules.lugar_exp.name) }}</span>
                </div>
            
                <!-- Fecha de expedición -->

                <div v-bind:class="['form-group','col-md-3', errors.first(rules.fecha_exp.name) ? 'has-error' :'']">
                    <label>F. de expedición *</label>
                    <input type="date" 
                        name="fecha de expedicion"
                        class="form-control"
                        v-model="personal.fecha_exp"
                        v-validate="rules.fecha_exp.rule">
                    <span class="help-block">@{{ errors.first(rules.fecha_exp.name) }}</span>
                </div>

            </div>

            <div class="col-md-12">

                <!-- Fecha de nacimiento -->

                <div v-bind:class="['form-group','col-md-3', errors.first(rules.fecha_nacimiento.name) ? 'has-error' :'']">
                    <label>F. de nacimiento *</label>
                    <input type="date" 
                        name="fecha de nacimiento" 
                        v-model="personal.fecha_nacimiento"
                        class="form-control"
                        v-validate="rules.fecha_nacimiento.rule">
                    <span class="help-block">@{{ errors.first(rules.fecha_nacimiento.name) }}</span>
                </div>

                <!-- Lugar de nacimiento  -->

                <div v-bind:class="['form-group','col-md-3', errors.first(rules.lugar_nacimiento.name) ? 'has-error' :'']">
                    <label>Lugar de nacimiento *</label>
                    <input type="text" 
                        name="lugar de nacimiento" 
                        class="form-control"
                        v-model="personal.lugar_nacimiento"
                        v-validate="rules.lugar_nacimiento.rule">
                    <span class="help-block">@{{ errors.first(rules.lugar_nacimiento.name) }}</span>
                </div>

                <!-- Genero  -->

                <div v-bind:class="['form-group','col-md-2', errors.first(rules.genero.name) ? 'has-error' :'']">
                    <label>Género *</label>
                    <select name="genero" 
                        v-model="personal.genero"
                        class="form-control"
                        v-validate="rules.genero.rule">
                        <option disabled selected>--</option>
                        <option :value="item" v-for="item in data.generos">@{{item}}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.genero.name) }}</span>
                </div>

                <!-- Estudios  -->

                <div v-bind:class="['form-group','col-md-2', errors.first(rules.nivel_estudios.name) ? 'has-error' :'']">
                    <label>Estudios *</label>
                    <select name="nivel de estudios" 
                        v-model="personal.nivel_estudios"
                        class="form-control"
                        v-validate="rules.nivel_estudios.rule">
                        <option disabled selected>--</option>
                        <option :value="item" v-for="item in data.nivel_estudios">@{{item}}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.nivel_estudios.name) }}</span>
                </div>

                <div v-bind:class="['form-group','col-md-2', errors.first(rules.estado_civil.name) ? 'has-error' :'']">
                    <label>Estado civil *</label>
                    <select name="estado civil"
                        v-model="personal.estado_civil"
                        class="form-control"
                        v-validate="rules.estado_civil.rule">
                        <option disabled selected>--</option>
                        <option :value="item" v-for="item in data.estado_civil">@{{ item }}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.estado_civil.name) }}</span>
                </div>

            </div>

            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <button class="btn btn-default" v-if="estado == 'edicion'"
                        @click="save">Salvar</button>
                    <button class="btn btn-primary">Continuar</button>
                </center>
            </div>
        
        </form>

    </div>

</script>


<script>

    Vue.component('datos_personales-component',{
        template: '#datos_personales-template',
        data () {
            return {
                estado: this.$store.state.estado,
                personal: this.$store.state.info_personal,
                rules: rules_personales,
                warning_message: false,
                message: ''
            }
        },
        computed: {
            data () { return this.$store.state.data; }
        },
        methods: {
            async continuar () {

                var route = '/start/clientes/validar/documento/'+this.$store.state.cliente_id;

                // valida si el documento existe

                let res = await axios.post(route, {
                    tipo_doc: this.personal.tipo_doc,
                    num_doc: this.personal.num_doc
                })

                if (res.data.dat) {
                    this.warning_message = true
                    this.message = res.data.message
                } else {
                    this.warning_message = false
                    this.message = ''
                    $('.nav-tabs a[href="#ubicacion"]').tab('show');
                    console.log('continuar')
                }

            },
            async onSubmit () {

                let valid = await this.$validator.validate()

                if ( (this.estado == 'creacion' || this.estado == 'edicion') && valid) {
                    this.$store.commit('setPersonal',this.personal)
                    this.continuar();
                }  
                else if(!valid){
                    alert('Por favor complete la informacion requerida')
                }
            },
            async save() {
                console

                await this.$store.commit('setPersonal',this.personal)
                var res = this.$store.dispatch('update');
            }
        }
    });

</script>

<style scoped>
    .help-block {
        font-size: 10px;
    }
</style>