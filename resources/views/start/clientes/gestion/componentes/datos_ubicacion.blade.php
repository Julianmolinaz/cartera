<script type="text/x-template" id="ubicacion-template">
    <div>
       
       <div class="row">
            <form @submit.prevent="onSubmit">
                <div class="col-md-12">

                    <!-- Direccion  -->

                    <div v-bind:class="['form-group','col-md-6',errors.first(rules.direccion.name) ? 'has-error' :'']">
                        <label>Dirección *</label>
                        <input type="text" 
                            class="text form-control"
                            placeholder="dirección de residencia"
                            v-model="ubicacion.direccion"
                            name="direccion"
                            v-validate="rules.direccion.rule">
                        <span class="help-block">@{{ errors.first(rules.direccion.name) }}</span>
                    </div>

                    <!-- Barrio  -->

                    <div v-bind:class="['form-group','col-md-6',errors.first(rules.barrio.name) ? 'has-error' :'']">
                        <label>Barrio*</label>
                        <input type="text" 
                            class="text form-control"
                            placeholder="barrio de residencia"
                            v-model="ubicacion.barrio"
                            name="barrio"
                            v-validate="rules.barrio.rule">
                        <span class="help-block">@{{ errors.first(rules.barrio.name) }}</span>
                    </div>
                </div>
                <div class="col-md-12">

                    <!-- Municipio  -->

                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.municipio.name) ? 'has-error' :'']">

                        <label>Municipio*</label>
                        <input type="text" 
                            class="text form-control"
                            ref="mun"
                            name="municipio"
                            @keyup="getMunicipios"
                            v-validate="rules.municipio.rule">
                        <span class="help-block">@{{ errors.first(rules.municipio.name) }}</span>

                        <input type="hidden" v-model="ubicacion.municipio_id">

                        <div class="list-group" 
                            style="position:absolute;z-index:2;background:white"
                            v-if="show_mun">
                            <a class="list-group-item list-group-item-action"
                                style="cursor:pointer;"
                                @click="setMunicipio(mun)"
                                v-for="mun in arr_mun">@{{mun.nombre}}-@{{mun.departamento}}</a>
                        </div>
                    
                    </div>

                    <!-- Estrato  -->

                    <div v-bind:class="['form-group','col-md-2',errors.first(rules.estrato.name) ? 'has-error' :'']">
                        <label>Estrato*</label>
                        <select type="text" 
                            class="form-control"
                            v-model="ubicacion.estrato"
                            name="estrato"
                            v-validate="rules.estrato.rule">
                            <option disabled selected>--</option>
                            <option :value="item" v-for="item in data.estrato">@{{ item }}</option>
                        </select>
                        <span class="help-block">@{{ errors.first(rules.estrato.name) }}</span>
                    </div>

                    <!-- Años en residencia  -->

                    <div v-bind:class="['form-group','col-md-3',errors.first(rules.anos_residencia.name) ? 'has-error' :'']">

                        <label>Tiempo en residencia*</label>
                        <input type="text" 
                            class="text form-control" 
                            placeholder="años"
                            v-model="ubicacion.anos_residencia"
                            name="años en residencia"
                            v-validate="rules.anos_residencia.rule">
                        <span class="help-block">@{{ errors.first(rules.anos_residencia.name) }}</span>

                    </div>

                    <!-- Meses en residencia  -->

                    <div v-bind:class="['form-group','col-md-3',errors.first(rules.meses_residencia.name) ? 'has-error' :'']">
                        <label>...</label>
                        <input type="text" 
                            class="text form-control" 
                            placeholder="meses"
                            v-model="ubicacion.meses_residencia"
                            name="meses en residencia"
                            v-validate="rules.meses_residencia.rule">
                        <span class="help-block">@{{ errors.first(rules.meses_residencia.name) }}</span>
                    </div>
                </div>

                <div class="col-md-12" style="z-index:1">

                    <!-- Celular  -->

                    <div v-bind:class="['form-group','col-md-3',errors.first(rules.movil.name) ? 'has-error' :'']">
                        <label>Celular*</label>
                        <input type="text" 
                            class="form-control"
                            v-model="ubicacion.movil"
                            name="celular"
                            v-validate="rules.movil.rule">
                        <span class="help-block">@{{ errors.first(rules.movil.name) }}</span>
                    </div>

                    <!-- Telefono  -->

                    <div v-bind:class="['form-group','col-md-3',errors.first(rules.fijo.name) ? 'has-error' :'']">
                        <label>Teléfono</label>
                        <input type="text" 
                            class="form-control"
                            v-model="ubicacion.fijo"
                            name="telefono"
                            v-validate="rules.fijo.rule">
                        <span class="help-block">@{{ errors.first(rules.fijo.name) }}</span>
                    </div>

                    <!-- Correo electronico -->

                    <div v-bind:class="['form-group','col-md-6',errors.first(rules.email.name) ? 'has-error' :'']">
                        <label>Correo electrónico*</label>
                        <input type="text" 
                            class="form-control"
                            v-model="ubicacion.email"
                            name="correo electronico"
                            v-validate="rules.email.rule">
                        <span class="help-block">@{{ errors.first(rules.email.name) }}</span>
                    </div>

                </div>

                <div class="col-md-12">

                    <!-- Tipo de vivienda  -->

                    <div v-bind:class="['form-group','col-md-2',errors.first(rules.tipo_vivienda.name) ? 'has-error' :'']">
                        <label style="font-size:10px;">Tipo de vivienda*</label>
                        <select type="text" 
                            class="form-control"
                            v-model="ubicacion.tipo_vivienda"
                            name="tipo de vivienda"
                            v-validate="rules.tipo_vivienda.rule">
                            <option disabled selected>--</option>
                            <option :value="item" v-for="item in data.tipo_vivienda">@{{ item }}</option>
                        </select>
                        <span class="help-block">@{{ errors.first(rules.tipo_vivienda.name) }}</span>
                    </div>

                    <!-- Envio de correspondencia  -->

                    <div v-bind:class="['form-group','col-md-3',errors.first(rules.envio_correspondencia.name) ? 'has-error' :'']">
                        <label style="font-size:10px;">Envío de correspondencia</label>
                        <select type="text" 
                            class="form-control"
                            v-model="ubicacion.envio_correspondencia"
                            name="envio de correspondencia"
                            v-validate="rules.envio_correspondencia.rule">
                            <option disabled selected>--</option>
                            <option :value="item" v-for="item in data.envio_correspondencia">@{{ item }}</option>
                        </select>
                        <span class="help-block">@{{ errors.first(rules.envio_correspondencia.name) }}</span>
                    </div>

                    <!-- Nombre arrendador  -->

                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.nombre_arrendador.name) ? 'has-error' :'']">
                        <label>Nombre arrendador</label>
                        <input type="text" 
                            class="form-control"
                            v-model="ubicacion.nombre_arrendador"
                            name="nombre arrendador"
                            v-validate="rules.nombre_arrendador.rule">
                        <span class="help-block">@{{ errors.first(rules.nombre_arrendador.name) }}</span>
                    </div>

                    <!-- Telefono arrendador  -->

                    <div v-bind:class="['form-group','col-md-3',errors.first(rules.telefono_arrendador.name) ? 'has-error' :'']">
                        <label>Teléfono arrendador</label>
                        <input type="text" 
                            class="form-control"
                            v-model="ubicacion.telefono_arrendador"
                            name="telefono arrendador"
                            v-validate="rules.telefono_arrendador.rule">
                        <span class="help-block">@{{ errors.first(rules.telefono_arrendador.name) }}</span>
                    </div>
                    
                </div>

                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <button class="btn btn-default" v-if="estado == 'edicion'">Salvar</button>
                        <a class="btn btn-default" v-if="estado == 'creacion'" @click="volver">Volver</a>
                        <button class="btn btn-primary">Continuar</button>
                    </center>
                </div>
            </form>        
       </div>

    </div>
</script>


<script>


    const rules_ubicacion = {
        direccion              : { name: 'direccion',            rule: 'required|regex:^([a-zA-Z0-9  ]+)$'},
        barrio                 : { name: 'barrio',               rule: 'required|alpha_dash'},
        municipio              : { name: 'municipio',            rule: 'required|alpha' },
        movil                  : { name: 'celular',              rule: 'required|numeric|min:10|max:10' },
        fijo                   : { name: 'telefono',             rule: 'numeric|min:7' },
        email                  : { name: 'correo electronico',   rule: 'required|email' },
        estrato                : { name: 'estrato',              rule: 'required' }, 
        anos_residencia        : { name: 'años en residencia',   rule: 'required|integer|min_value:0|max_value:75'}, 
        meses_residencia       : { name: 'meses en residencia',  rule: 'required|integer|max_value:11'}, 
        tipo_vivienda          : { name: 'tipo de vivienda',     rule: 'required' }, 
        envio_correspondencia  : { name: 'envio de correspondencia', rule: '' }, 
        nombre_arrendador      : { name: 'nombre arrendador',    rule: 'alpha' }, 
        telefono_arrendador    : { name: 'telefono arrendador',  rule: 'numeric|min:7|max:10'}
    }


    const ubicacion = Vue.component('ubicacion-component',{
        template: '#ubicacion-template',
        data () {
            return {
                estado      : this.$store.state.estado,
                show_mun    : false,
                municipio   : '',
                municipios  : this.$store.state.municipios,
                arr_mun     : [],
                ubicacion   : this.$store.state.info_ubicacion,
                rules       : rules_ubicacion,
                data        : this.$store.state.data
            }
        },
        methods: {
            getMunicipios () {

                let str_mun = this.$refs.mun.value
                
                if (str_mun.length > 0) {
               
                    this.arr_mun = this.municipios.filter( mun => 
                        mun.nombre.toLowerCase().includes(str_mun.toLowerCase())
                    )
                    if (this.arr_mun) {
                        this.show_mun = true
                    }

                } else {

                    this.show_mun = false
                    return false
                }
                
            },
            setMunicipio ( municipio ) {

                this.show_mun               = false
                this.ubicacion.municipio_id = municipio.id
                this.$refs.mun.value        = municipio.nombre
            },
            volver () {
                $('.nav-tabs a[href="#personales"]').tab('show') 
            },
            continuar () {
                $('.nav-tabs a[href="#actividad"]').tab('show') 
                console.log('continuar')
            },
            async onSubmit () {

                if (this.show_mun) {
                    this.$refs.mun.value = ''
                    this.show_mun = false
                }

                let valid = await this.$validator.validate()

                if (this.$store.state.estado == 'creacion' && valid) {
                    this.$store.commit('setUbicacion',this.ubicacion)
                    this.continuar();
                } 
                else if (this.estado == 'edicion' && valid) {
                    let res = await this.$store.dispatch('update')
                } 
                else {
                    alert('Por favor complete la informacion requerida')
                }
            },//onSubmit
            setMunicipio2() {
                if (this.estado == 'edicion') {
                    municipio = this.municipios.filter( mun => 
                        mun.id == this.$store.state.info_ubicacion.municipio_id
                    )

                    this.$refs.mun.value = municipio[0].nombre
                }
            }
        },
        mounted(){
            this.setMunicipio2()
        }
    });

</script>