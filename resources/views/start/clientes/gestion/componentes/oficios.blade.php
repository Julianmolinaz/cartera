
<script type="text/x-template" id="oficios-template">

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_oficios">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header my-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span class="glyphicon glyphicon-education"></span>
                    <template v-if="estado=='crear'">Crear</template><template v-else>Editar</template> Oficio u Ocupación</h4>
               
            </div>
            <div class="modal-body">
                @permission('crear_editar_oficios')
                    <div class="form-group">
                        <label>Nombre del nuevo oficio</label>            
                        <input type="text" class="form-control" v-model="oficio.nombre">
                    </div>
                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Cerrar</button>
                    
                    
                    <button type="button" class="btn btn-primary float-left" @click="onSubmit">
                        Salvar
                    </button>
                @endpermission
                
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
                                    @permission('crear_editar_oficios')
                                        <a href="#" @click="editar(item)" class="btn btn-xs btn-primary">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                    @endpermission
                                    @permission('eliminar_oficios')
                                        <a href="#" @click="destroy(item)" class="btn btn-xs btn-danger">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </a>
                                    @endpermission
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
                        self.$store.commit('setOficios',res.data.dat)
                    })
            },
            onSubmit() {

                if (!this.oficio.nombre) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Se requiere el nombre del oficio', 'error', 5, function(){  console.log(''); });
                    return false
                }

                if (this.estado == 'crear') { this.store() }
                else { this.update() }
                
            },
            store() {

                var self = this

                axios.post('/start/oficios',{ nombre: this.oficio.nombre })
                .then( res => {
                    alertify.set('notifier','position', 'top-right');
                    if (!res.data.error) {

                        alertify.notify(res.data.message, 'success', 5, function(){  console.log(''); });

                        self.getOficios()
                        self.reset()
                    } else {
                        alertify.notify(res.data.message, 'error', 5, function(){  console.log(''); });
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
                        alertify.set('notifier','position', 'top-right');
                        
                        if (!res.data.error) {
                            alertify.notify(res.data.message, 'success', 5, function(){  console.log(''); });
                            self.getOficios()
                            self.reset()
                        } else {
                            alertify.notify(res.data.message, 'error', 5, function(){  console.log(''); });
                        }
                    } )
            },
            destroy(oficio) {

                var self = this

                alertify.confirm('Eliminar Oficio', 'Esta seguro de borrar el oficio', 
                    function(){ 
                        axios.get('/start/oficios/delete/'+oficio.id).then( res => {
                            
                            if (!res.data.error) {
                                alertify.success(res.data.message) 
                                self.getOficios()
                                self.reset()
                            } else {
                                alertify.error(res.data.dat);
                            }

                        })
                        
                        
                    }
                    , function(){ 
                        alertify.error('Borrado Cancelado')
                });                
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