<script type="text/x-template" id="anotacion-template">
    <div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Anotación</h3>
            </div>
            <div class="panel-body">
                <form v-on:submit.prevent>
                    <div class="form-group">
                        <label>Asunto *</label>
                        <input type="text" class="form-control" v-model="anotacion.asunto" 
                            :readonly="status == 'consulta'">
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" cols="30" rows="6" v-model="anotacion.descripcion" 
                            :readonly="status == 'consulta'"></textarea>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" v-model="anotacion.notificar" :checked="anotacion.recordatorio"
                                :readonly="status == 'consulta'"> Notificar
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Fecha *</label>
                        <input type="date" class="form-control" v-model="anotacion.recordatorio"
                            :readonly="status == 'consulta'">
                    </div>
                    <button class="btn btn-primary" v-if="status == 'crear'" @click="onSubmit()">Guardar</button>
                    <button class="btn btn-primary" v-if="status == 'consulta'" @click="reset()">Crear Anotación</button>
                    <button class="btn btn-primary" v-if="status == 'editar'" @click="onSubmit()">Guardar Cambios</button>
                </form>

            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('anotacion-component',{
        template: '#anotacion-template',
        data(){
            return {
                status : 'crear',
                credito : {!! $credito !!},
                anotacion : {
                    id : '',
                    asunto : '',
                    descripcion : '',
                    notificar : false,
                    recordatorio : '',
                    proceso_id : '',
                    user_create_id: '',
                    user_update_id: '',
                    created_at : '',
                    updated_at : ''
                }
            }
        },
        methods : {
            onSubmit(){
                if(this.status == 'crear')
                    this.store()
                else if(this.status == 'editar')
                    this.update()
            },
            store(){
                var self = this
                axios.post('/admin/anotaciones',this.anotacion)
                    .then( res => {
                        alert(res.data.message)

                        if(!res.data.error){
                            self.reset()
                            Bus.$emit('getAnotaciones')
                        }
                    })
            },
            update(){
                var self = this
                axios.put('/admin/anotaciones/'+this.anotacion.id,this.anotacion)
                    .then( res => {
                        alert(res.data.message)
                        if(!res.data.error){
                            self.reset()
                            Bus.$emit('getAnotaciones')
                        }
                    })
            },
            reset(){
                this.status = 'crear'
                this.anotacion.id = ''
                this.anotacion.asunto = '',
                this.anotacion.descripcion = ''
                this.anotacion.notificar = false
                this.anotacion.recordatorio = ''
                this.anotacion.user_create_id = ''
                this.anotacion.user_update_id = ''
                this.anotacion.created_at     = ''
                this.anotacion.updated_at     = ''
                if(this.anotacion.user_create)
                    this.anotacion.user_create = ''
            },
            cargarAnotacion(anotacion){
                this.anotacion = JSON.parse(JSON.stringify(anotacion))

                if( this.anotacion.notificado == 'Si' ||
                    this.anotacion.notificado == 'Espera'){
                        this.anotacion.notificar = true
                    }
            }
        },
        created(){
            var self = this

            if(this.credito.proceso){
                this.anotacion.proceso_id = this.credito.proceso.id
            }

            Bus.$on('showAnotacion', anotacion => {
                self.cargarAnotacion(anotacion)
                self.status = 'consulta'
            })

            Bus.$on('editarAnotacion', anotacion => {
                self.cargarAnotacion(anotacion)
                self.status = 'editar'
            })

            Bus.$on('setProceso',function(proceso){
                self.anotacion.proceso_id = proceso.id
            }) 

        }
    })
</script>