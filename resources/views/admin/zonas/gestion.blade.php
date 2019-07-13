
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
            <button type="submit" class="btn btn-default">Guardar</button>
        </form>    
    </div>
    @{{ $data }}
</script>

<script>

    Vue.use(VeeValidate);

    Vue.component('gestion-zona', {
        template: "#gestion_zona-template",
        data(){
            return {
                status : 'create',
                zona : {
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
                            }
                        } else {
                            alert('no')
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
                            console.log('cargar zonas');
                            self.reset()
                        }
                    })
            },
            update(){

            },
            reset(){
                this.status = 'create'
                this.zona.nombre = ''
                this.zona.descripcion = ''
            }
        }
    })
</script>