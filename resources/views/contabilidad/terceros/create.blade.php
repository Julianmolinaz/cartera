<script type="text/x-template" id="create-template">

    <div>

        <div class="modal fade" id="create">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Tercero</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="alert alert-dismissible alert-danger" v-if="show_errors">
                        <div v-for="error in errores">
                            <span v-for="e in error">@{{e}}</span>
                        </div>
                    </div>
                    
                    <form @submit.prevent="onSubmit">
                        {{ csrf_field() }}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Tipo *</label>
                                    <select class="form-control" v-model="tercero.tipo" name="Tipo">
                                        <option selected disabled>Tipo *</option>
                                        <option :value="tipo" v-for="tipo in data.tipos">@{{tipo}}</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Regimen *</label>
                                    <select class="form-control" v-model="tercero.regimen">
                                        <option selected disabled>Régimen *</option>
                                        <option :value="regimen" v-for="regimen in data.regimenes">
                                            @{{regimen}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Razón social</label>
                                    <input type="text" class="form-control" v-model="tercero.razon_social">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Primer nombre *</label>
                                    <input type="text" class="form-control" v-model="tercero.pnombre">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Segundo nombre</label>
                                    <input type="text" class="form-control" v-model="tercero.snombre">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Primer apellido *</label>
                                    <input type="text" class="form-control" v-model="tercero.papellido">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Segundo apellido</label>
                                    <input type="text" class="form-control" v-model="tercero.sapellido">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Tipo de documento *</label>
                                    <select class="form-control" v-model="tercero.tipo_doc">
                                        <option selected disabled>Tipo de documento</option>
                                        <option :value="tipo" v-for="tipo in data.tipos_doc">
                                            @{{ tipo }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Número de documento *</label>
                                    <input type="text" class="form-control" v-model="tercero.num_doc">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Teléfono 1</label>
                                    <input type="text" class="form-control" v-model="tercero.tel1">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Telefono 2</label>
                                    <input type="text" class="form-control" v-model="tercero.tel2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Dirección</label>
                                    <input type="text" class="form-control" v-model="tercero.dir">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Municipio</label>
                                    <select class="form-control" v-model="tercero.mun_id">
                                        <option selected disabled>Municipio</option>
                                        <option :value="municipio.id" v-for="municipio in data.municipios">
                                            @{{municipio.nombre+'-'+municipio.departamento}}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" v-model="tercero.email">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="onSubmit">Guardar Tercero</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


</script>


<script src="{{asset('js/interfaces/tercero.js')}}"></script>
<script>

    Vue.component('crear_tercero-component', {
        template: '#create-template',
        data() {
            return {
                tercero: new Tercero(),
                data: '',
                errores: [],
                show_errors : false
            }
        },
        methods: {
            getData() {
                var self = this;
                axios.get('/contabilidad/terceros/create')
                    .then(res => {
                        if (res.data.success) {
                            self.data = res.data.dat;
                        }
                    });
            },
            showModal() {
                $('#create').modal('show');
            },
            onSubmit() {
                this.show_errors = false;
                var self = this;
                axios.post('/contabilidad/terceros',this.tercero)
                    .then( res => {
                        if(res.data.success){
                            alert(res.data.message);
                            $('#create').modal('hide');
                            self.tercero = new Tercero();
                            Bus.$emit('getTerceros');
                        } else {
                            self.show_errors = true;
                            self.errores = res.data.dat;
                        }
                    })
                    .catch( error => {
                        if (error.response.headers.connection == 'close') {
                            // window.location.href = "{{url('/log')}}";
                        }
                    });
            },
            validator() {
                // await this.$validator.validateAll();
            }
        },
        created() {
            var self = this
            this.getData();
            Bus.$on('crearTercero', () => {
                this.showModal();
            });
        }
    });
</script>