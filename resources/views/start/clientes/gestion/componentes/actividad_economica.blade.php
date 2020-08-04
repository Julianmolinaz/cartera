<script type="text/x-template" id="actividad_economica-template">

    <div class="row">

        <form @submit.prevent="onSubmit">

            <input type="hidden" >

            <div class="col-md-12">

                <div v-if="danger_message" class="alert alert-danger" role="alert">
                    <ul>
                        <li v-for="item in arr_messages">@{{item[0]}}</li>
                    </ul>
                </div>

                <!-- Ocupacion  -->

                <div v-bind:class="['form-group','col-md-6',errors.first(rules.oficio.name) ? 'has-error' :'']">
                    <label>Ocupacion u oficio @{{rules.oficio.required}}</label>
                    <select class="form-control"
                        name="oficio"
                        v-model="economia.oficio"
                        @change="analizarOficio"
                        v-validate="rules.oficio.rule">
                        <option selected disabled>Ocupación principal</option>
                        <option :value="item.nombre" v-for="item in data.oficios">@{{ item.nombre }}</option>
                        <option :value="'Otro'">Otro</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.oficio.name) }}</span>
                </div>

                <oficios-component></oficios-component>

                <!-- Tipo de actividad  -->

                <div v-bind:class="['form-group','col-md-6',errors.first(rules.tipo_actividad.name) ? 'has-error' :'']">
                    <label>Tipo de actividad @{{rules.tipo_actividad.required}}</label>
                    <select class="form-control"
                        v-model="economia.tipo_actividad"
                        name="tipo de actividad"
                        v-validate="rules.tipo_actividad.rule"
                        @change="activityAction">
                        <option selected disabled>--</option>
                        <option :value="item" v-for="item in data.tipo_actividad">@{{ item }}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.tipo_actividad.name) }}</span>
                </div>
            </div>
    
            <div class="col-md-12" v-if="economia.tipo_actividad">

                <!-- Nombre empresa  -->

                <div v-bind:class="['form-group','col-md-6',errors.first(rules.empresa.name) ? 'has-error' :'']">
                    <label>Nombre empresa @{{rules.empresa.required}} </label>
                    <input type="text" 
                        class="text form-control"
                        name="nombre empresa"
                        v-model="economia.empresa"
                        v-validate="rules.empresa.rule">
                    <span class="help-block">@{{ errors.first(rules.empresa.name) }}</span>
                </div>

                <!-- Direccion empresa -->

                <div v-bind:class="['form-group','col-md-6',errors.first(rules.dir_empresa.name) ? 'has-error' :'']">
                    <label>Direccion @{{rules.dir_empresa.required}}</label>
                    <input type="text" 
                        class="text form-control"
                        name="direccion empresa"
                        v-model="economia.dir_empresa"
                        v-validate="rules.dir_empresa.rule">
                    <span class="help-block">@{{ errors.first(rules.dir_empresa.name) }}</span>
                </div>
            </div>

            <div class="col-md-12" v-if="economia.tipo_actividad == 'Dependiente'">

                <!-- Documento empresa  -->

                <div v-bind:class="['form-group','col-md-4',errors.first(rules.doc_empresa.name) ? 'has-error' :'']">
                    <label>Nit/Cédula @{{rules.doc_empresa.required}}</label>
                    <input type="text" 
                        class="text form-control"
                        name="identificacion empreasa"
                        v-model="economia.doc_empresa"
                        v-validate="rules.doc_empresa.rule">
                    <span class="help-block">@{{ errors.first(rules.doc_empresa.name) }}</span>
                </div>

                <!-- Tipo contrato  -->

                <div v-bind:class="['form-group','col-md-4',errors.first(rules.tipo_contrato.name) ? 'has-error' :'']">
                    <label>Tipo de contrato @{{rules.tipo_contrato.required}}</label>
                    <select class="form-control"
                        name="tipo de contrato"
                        v-model="economia.tipo_contrato"
                        v-validate="rules.tipo_contrato.rule">
                        <option disabled selected>--</option>
                        <option :value="item" v-for="item in data.tipo_contrato">@{{ item }}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.tipo_contrato.name) }}</span>
                </div>

                <!-- Cargo  -->

                <div v-bind:class="['form-group','col-md-4',errors.first(rules.cargo.name) ? 'has-error' :'']">
                    <label>Cargo @{{rules.cargo.required}}</label>
                    <input type="text" 
                        class="text form-control"
                        name="cargo"
                        v-model="economia.cargo"
                        v-validate="rules.cargo.rule">
                    <span class="help-block">@{{ errors.first(rules.cargo.name) }}</span>
                </div>

            </div>

            <div class="col-md-12" v-if="economia.tipo_actividad">

                <!-- Telefono empresa  -->

                <div v-bind:class="['form-group','col-md-6',errors.first(rules.tel_empresa.name) ? 'has-error' :'']">
                    <label>Teléfono empresa @{{rules.tel_empresa.required}}</label>
                    <input type="text" 
                        class="text form-control"
                        name="telefono empresa"
                        v-model="economia.tel_empresa"
                        v-validate="rules.tel_empresa.rule">
                    <span class="help-block">@{{ errors.first(rules.tel_empresa.name) }}</span>
                </div>

                <!-- Fecha de vinculación  -->
            
                <div v-bind:class="['form-group','col-md-6',errors.first(rules.fecha_vinculacion.name) ? 'has-error' :'']">
                    <label>Fecha de vinculación @{{rules.fecha_vinculacion.required}}</label>
                    <input type="date" name="" id="" 
                        class="form-control"
                        name="fecha de vinculacion"
                        v-model="economia.fecha_vinculacion"
                        v-validate="rules.fecha_vinculacion.rule">
                    <span class="help-block">@{{ errors.first(rules.fecha_vinculacion.name) }}</span>
                </div>


            </div>
            <div class="col-md-12"  v-if="economia.tipo_actividad == 'Independiente'">

            <!-- Descripcion actividad  -->

            <div v-bind:class="['form-group','col-md-12',errors.first(rules.descripcion_actividad.name) ? 'has-error' :'']">
                    <label for="">Descripcion actividad @{{rules.descripcion_actividad.required}}</label>
                    <textarea class="form-control"
                        name="descripcion"
                        v-model="economia.descripcion_actividad"
                        v-validate="rules.descripcion_actividad.rule">
                    </textarea>
                    <span class="help-block">@{{ errors.first(rules.descripcion_actividad.name) }}</span>
                </div>
            </div>

            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <a class="btn btn-default" v-if="estado == 'creacion'" @click="volver">Volver</a>
                    <button class="btn btn-default">Salvar</button>
                    <button class="btn btn-primary">Salvar y Continuar</button>
                </center>
            </div>

        </form>

    </div>

</script>

@include('start.clientes.gestion.componentes.oficios')

<script>

    Vue.component('actividad_economica-component',{
        template: '#actividad_economica-template',
        data() {
            return {
                estado          : this.$store.state.estado,
                rules           : rules_economica,
                economia        : this.$store.state.info_economica,
                data            : this.$store.state.data,
                danger_message  : false,
                arr_messages    : '',
                oficios         : this.$store.state.data.oficios
            }
        },
        methods: {
            volver () {
                $('.nav-tabs a[href="#ubicacion"]').tab('show') 
            },
            continuar () {
                this.message = ''
                this.danger_message = false
                $('.nav-tabs a[href="#conyuge"]').tab('show')
            },
            async onSubmit (action) {

                let valid = await this.$validator.validate()

                if (this.estado == 'creacion' && valid) {
                    await this.$store.commit('setEconomica',this.economia)

                    let res = await axios.post('/start/clientes',{
                        cliente: this.$store.state.cliente,
                        cliente_id: this.$store.state.cliente_id,
                    });

                    alert(res.data.message);

                    if (res.data.success) {

                        if (res.data.message == '') {
                            this.arr_messages = res.data.dat
                            this.danger_message = true
                        } 
                        else {
                            if (action == 'continuar') { 
                                this.$store.commit('setClienteId',res.data.dat.id)
                                this.continuar()
                            } else { 
                                document.location.href= "/start/clientes/"+res.data.dat.id 
                            }
                        }
                    } else {
                        this.message = res.data.message
                    }

                } 
                else if (this.estado == 'edicion' && valid) {
                    this.$store.dispatch('update')
                } 
                else {
                    alert('Por favor complete la informacion requerida')
                }
            },
            activityAction () {

                this.rules = rules_economica;

                this.rules.fecha_vinculacion.rule  = 'required';
                this.rules.fecha_vinculacion.required  = '*'; 

                if (this.economia.tipo_actividad == 'Dependiente') {
                    
                    this.rules.empresa.rule            = 'required';
                    this.rules.empresa.required        = '*';

                    this.rules.tel_empresa.rule        = 'required';
                    this.rules.tel_empresa.required    = '*';

                    this.rules.dir_empresa.rule        = 'required';
                    this.rules.dir_empresa.required    = '*';

                    this.rules.cargo.rule              = 'required';
                    this.rules.cargo.required          = '*';

                    this.rules.tipo_contrato.rule      = 'required'; 
                    this.rules.tipo_contrato.required  = '*';

                } else if (this.economia.tipo_actividad == 'Independiente'){

                    this.rules.descripcion_actividad.rule     = 'required';
                    this.rules.descripcion_actividad.required = '*';
                }
            },//.activityAction
            analizarOficio () {

                if (this.economia.oficio == 'Otro') {
                    Bus.$emit('setOficio')
                }
            }
         }
        
    });

</script>