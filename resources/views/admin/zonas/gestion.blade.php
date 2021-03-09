
<script type="text/x-template" id="gestion_zona-template">

    <div>
        <form v-on:submit.prevent="onSubmit()">
            <div class="form-group">
                <label>Nombre *:</label>
                <input type="text" class="form-control" placeholder="nombre de la zona"
                       v-model="zona.nombre" v-validate="'required'">
            </div>
            <div class="form-group">
                <label>Descripcion</label>
                <textarea class="form-control" cols="30" rows="10"
                          v-model="zona.descripcion"></textarea>
            </div>
            <button type="submit" class="btn btn-default" 
                    @click="onSubmit()"
                    v-if="status == 'create'">
                Guardar</button>
            <button type="submit" class="btn btn-default" 
                    @click="onSubmit()"
                    v-else>
                Guardar Cambios</button>
        </form>    
    </div>
</script>

<script>

    Vue.use(VeeValidate);

    Vue.component('gestion-zona', {
        template: "#gestion_zona-template",
        data(){
            return {
                status : 'create',
                zona : {
                    id : '',
                    nombre : '',
                    descripcion : ''
                }
            }
        },
        methods: {
            onSubmit(){

                var self = this
                this.$validator.validate()
                    .then( validate => {
                        if(validate){
                            if(self.status == 'create'){
                                self.store()
                            } else {
                                self.update()
                            }
                        } else {
                            console.log(validate)
                        }
                    })
            },
            store(){
                var self = this
                axios.post('/admin/zonas', this.zona)
                    .then( res => {
                        console.log({res});
                        alert(res.data.message)
                        if(!res.data.error){
                            Bus.$emit('getZonas')
                            self.reset()
                        }
                    })
            },
            update(){
                alert()
                var self = this
                var ruta = '/admin/zonas/'+this.zona.id;
                console.log({ruta});
                axios.put(ruta, this.zona)
                    .then( res => {
                        console.log({res});
                        if(!res.data.error){
                            Bus.$emit('getZonas')
                            self.reset()
                        }
                    }) 
            },
            reset(){
                this.status = 'create'
                this.zona.nombre = ''
                this.zona.descripcion = ''
            }
        },
        created(){
            var self = this
            Bus.$on('editZona', function(zona){
                console.log({zona});                
                self.zona = zona
                self.status = 'edit'
            })
        }
    })
</script>