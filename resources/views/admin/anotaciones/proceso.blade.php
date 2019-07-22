
<script type="text/x-template" id="proceso-template">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fas fa-gavel"></i>&nbsp;Proceso</h3>
        </div>
        <div class="panel-body">
            <form v-on:submit.prevent>
                
                <p class="help-block" v-if="!proceso.id">Por favor cree un proceso para agragar el seguimiento</p>

                <div class="form-group">
                    <label>Juzgado</label>
                    <input type="text" class="form-control" v-model="proceso.juzgado" :readonly="status == 'consulta'">
                </div>
                <div class="form-group">
                    <label>Número de radicación</label>
                    <input type="text" class="form-control" v-model="proceso.radicado" :readonly="status == 'consulta'">
                </div>   
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" class="form-control" v-model="proceso.fecha_radicado" :readonly="status == 'consulta'">
                </div>                        

                <button type="submit" class="btn btn-primary" @click="onSubmit()" v-if="status == 'crear'"> Guardar
                </button>
                <button type="submit" class="btn btn-primary" @click="onSubmit()" v-if="status == 'editar'">Guardar Cambios</button>
                <button class="btn btn-primary" @click="status = 'editar'" v-if="status == 'consulta'">Editar el Proceso</button>
            </form>

        </div>
    </div>
</script>

<script>

    Vue.component('proceso-component',{
        template: '#proceso-template',
        data(){
            return {
                status : 'crear',
                credito : {!! $credito !!},
                proceso : {
                    id         : '',
                    juzgado    : '',
                    radicado   : '',
                    fecha_radicado : '',
                    credito_id : {!! $credito->id !!},
                    cliente_id : {!! $credito->precredito->cliente->id !!}
                }
            }
        },
        methods: {
            onSubmit(){
                if(this.proceso.fecha_radicado){
                    if(this.status == 'crear')
                        this.store()
                    else if(this.status == 'editar')
                        this.update()
                } else {
                    alert('Se requiere por lo menos la fecha de radicación')
                }
            },
            store(){

                var self = this

                axios.post('/admin/procesos', this.proceso)
                    .then( res => {
                        alert(res.data.message)

                        if(!res.data.error){
                            self.status = 'consulta'
                            Bus.$emit('setProceso',res.data.dat)
                            Bus.$emit('activarAnotaciones')
                        }
                    })
            },
            update(){

                var self = this

                axios.put('/admin/procesos/'+this.proceso.id,this.proceso)
                    .then( res => {
                        console.log({res});
                        
                        alert(res.data.message)

                        if(!res.data.error){
                            self.status = 'consulta'
                        }
                    })
            }
        },
        created(){
            if(this.credito.proceso){
                Bus.$emit('activarAnotaciones')
                this.status = 'consulta'
                this.proceso = this.credito.proceso
            }
        }
    })

</script>