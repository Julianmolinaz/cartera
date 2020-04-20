<script type="text/x-template" id="datos_personales-template">

    <div class="row">

        <form @submit.prevent="onSubmit">
        
            <div class="col-md-12">
                <div class="col-md-3">
                    
                    <div v-bind:class="['form-group', errors.first('primer nombre') ? 'has-error' :'']">
                        <label>Primer nombre *</label>
                        <input type="text" 
                            class="form-control"
                            name="primer nombre"
                            v-model="personal.primer_nombre"
                            v-validate="'required'">
                        <span class="help-block">@{{ errors.first('primer nombre') }}</span>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Segundo nombre</label>
                        <input type="text" class="form-control"
                            name="Segundo nombre"
                            v-model="personal.segundo_nombre">
                    </div>
                </div>
                <div class="col-md-3">
                    <div v-bind:class="['form-group', errors.first('primer apellido') ? 'has-error' :'']">
                        <label>Primer apellido *</label>
                        <input type="text" class="form-control"
                            name="primer apellido"
                            v-model="personal.primer_apellido"
                            v-validate="'required'">
                        <span class="help-block">@{{ errors.first('primer apellido') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Segundo apellido</label>
                        <input type="text" class="form-control"
                            name="Segundo Apellido"
                            v-model="personal.segundo_apellido">
                    </div>
                </div>
            
            </div>

            <div class="col-md-12">
                <div class="col-md-3">
                    <div v-bind:class="['form-group', errors.first('tipo de documento') ? 'has-error' :'']">
                        <label>Tipo de documento *</label>
                        <select name="tipo de documento" 
                            v-model="personal.tipo_doc"
                            class="form-control"
                            v-validate="'required'">
                            <option disabled selected>Tipo documento</option>
                            <option :value="tipo_doc" v-for="tipo_doc in tipo_docs">@{{tipo_doc}}</option>    
                        </select>
                        <span class="help-block">@{{ errors.first('tipo de documento') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div v-bind:class="['form-group', errors.first('numero de documento') ? 'has-error' :'']">
                        <label>Núm de documento *</label>
                        <input type="text" class="form-control"
                            name="numero de documento"
                            placeholder="Número de documento"
                            v-model="personal.num_doc"
                            v-validate="'required'">
                        <span class="help-block">@{{ errors.first('numero de documento') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div v-bind:class="['form-group', errors.first('expedido en') ? 'has-error' :'']">
                        <label>Expedido en *</label>
                        <input type="text" class="form-control"
                            name="expedido en"
                            placeholder="Ciudad donde se expidió el documento"
                            v-model="personal.ciudad_exp"
                            v-validate="'required'">
                        <span class="help-block">@{{ errors.first('expedido en') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div v-bind:class="['form-group', errors.first('fecha de expedicion') ? 'has-error' :'']">
                        <label>F. de expedición *</label>
                        <input type="date" 
                            name="fecha de expedicion"
                            class="form-control"
                            v-model="personal.fecha_exp"
                            v-validate="'required'">
                        <span class="help-block">@{{ errors.first('fecha de expedicion') }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div v-bind:class="['form-group','col-md-3', errors.first('fecha de nacimiento') ? 'has-error' :'']">
                    <label>F. de nacimiento *</label>
                    <input type="date" 
                        name="fecha de nacimiento" 
                        v-model="personal.fecha_nacimiento"
                        class="form-control"
                        v-validate="'required'">
                    <span class="help-block">@{{ errors.first('fecha de nacimiento') }}</span>
                </div>
                <div v-bind:class="['form-group','col-md-3', errors.first('lugar de nacimiento') ? 'has-error' :'']">
                    <label>Lugar de nacimiento *</label>
                    <input type="text" 
                        name="lugar de nacimiento" 
                        class="form-control"
                        v-model="personal.lugar_nacimiento"
                        v-validate="'required'">
                    <span class="help-block">@{{ errors.first('lugar de nacimiento') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label>Nivel de estudios *</label>
                    <select name="Nivel de estudios" 
                        v-model="personal.nivel_estudios"
                        class="form-control"></select>
                </div>
                <div class="form-group col-md-3">
                    <label>Estado civil *</label>
                    <select name="Estado civil"
                        v-model="personal.estado_civil"
                        class="form-control"></select>
                </div>
            </div>

            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <button class="btn btn-default">Salvar</button>
                    <button class="btn btn-primary" id="continuar_ubi">Continuar</button>
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
                personal: this.$store.state.info_personal
            }
        },
        computed: {
            tipo_docs () {
                return this.$store.state.tipo_docs
            }
        },
        methods: {
            continuar () {
                $('#ubicacion').tab('show')
            },
            onSubmit () {
                
            }
        }
    });

</script>