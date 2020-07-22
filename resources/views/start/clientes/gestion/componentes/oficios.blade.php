
<script type="text/x-template" id="oficios-template">

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_oficios">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span class="glyphicon glyphicon-education"></span>
                    <template v-if="estado=='crear'">Crear</template><template v-else>Editar</template> Oficio u Ocupación</h4>
               
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <label>Nombre del nuevo oficio</label>            
                    <input type="text" class="form-control" v-model="oficio.nombre">
                </div>
                <button type="button" class="btn btn-default float-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary float-left" @click="onSubmit">
                    Salvar
                </button>
                
                <button type="button" class="btn btn-link" v-if="estado=='editar'"
                    @click="reset">De click para crear un oficio</button>
                
                <hr>
                <div class="span3">
                    <table class="table table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th>Oficio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in oficios">
                                <td>
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    @{{item.nombre}}
                                </td>
                                <td>
                                    <a href="#" @click="editar(item)" class="btn btn-xs btn-primary">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    <a href="#" @click="destroy(item)" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                
            </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</script>

<script>

    Vue.component('oficios-component',{
        template: '#oficios-template',
        data: () => ({
            estado: 'crear',
            oficio: {
                nombre : ''
            }
        }),
        computed: {
            oficios() {
                return this.$store.getters.getOficios
            }
        },
        methods: {
            showModal() {
                $('#modal_oficios').modal('show')
            },
            hideModal() {
                $('#modal_oficios').modal('hide')
            },
            getOficios() {
                var self = this

                axios.get('/start/oficios')
                    .then( res => {
                        console.log({res})
                        self.$store.commit('setOficios',res.data.dat)
                    })
            },
            onSubmit() {

                console.log('Evento on submit');

                if (!this.oficio.nombre) {
                    alert('Se requiere el nombre del oficio');
                    return false
                }

                console.log('Estado:', this.estado);

                if (this.estado == 'crear') { this.store() }
                else { this.update() }
                
            },
            store() {

                var self = this

                axios.post('/start/oficios',{ nombre: this.oficio.nombre })
                .then( res => {
                    alert(res.data.message)

                    if (!res.data.error) {
                        self.getOficios()
                        self.reset()
                    }
                })
            },
            editar(oficio) {
                this.estado = 'editar'
                this.oficio  = JSON.parse(JSON.stringify(oficio))

            },
            update() {
                var self = this
                axios.post('/start/oficios/update',this.oficio)
                    .then( res => {
                        alert(res.data.message)

                        if (!res.data.error) {
                            self.getOficios()
                            self.reset()
                        }
                    } )
            },
            destroy(oficio) {

                var self = this

                if (!confirm('Esta seguro de borrar el oficio')) {
                    return false
                }

                axios.get('/start/oficios/delete/'+oficio.id)
                    .then( res => {
                        alert(res.data.message)

                        if (!res.data.error) {
                            self.getOficios()
                            self.reset()
                        } else {
                            console.log(res.data.dat);
                        }

                    })
            },
            reset() {
                this.estado = 'crear'
                this.oficio = {
                    nombre : ''
                }
            }
        },
        created() {

            var self = this
            Bus.$on('setOficio', () => {
                self.showModal()
            })
        },
        mounted() {
        }
    })
</script>

<style scoped>
    .span3 {  
        height: 300px !important;
        overflow: scroll;
    }​
</style>