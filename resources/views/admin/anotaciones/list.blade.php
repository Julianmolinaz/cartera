
<script type="text/x-template" id="list_anotaciones-template">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Anotaciones</h3>
        </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Asunto</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="anotacion in anotaciones2">
                    <td v-text="anotacion.asunto"></td>
                    <td v-text="anotacion.created_at"></td>
                    <td>
                        <a href="javascript:void(0);" class='btn btn-default btn-xs'
                            @click="show(anotacion)">
                            <span class="glyphicon glyphicon-eye-open" title="Ver"></span>
                        </a>
                        <a href="javascript:void(0);" class='btn btn-default btn-xs'
                            @click="editar(anotacion)">
                            <span class="glyphicon glyphicon-pencil" title="Editar"></span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <center>
        <nav aria-label="Page navigation" v-if="pag.paginas > 0">
            <ul class="pagination">
                <li>
                <a href="#" aria-label="Previous" @click="actionPaginate('previus')">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li v-for="(pagina, index) in pag.paginas" :class="{active: (index + 1 == pag.pagina_actual)}">
                    <a href="#" v-text="index + 1" @click="actionPaginate(index + 1)"></a>
                </li>
                <li>
                <a href="#" aria-label="Next" @click="actionPaginate('next')">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
        </center>
    </div>
    </div>
</script>

<script>

    Vue.component('list-anotaciones',{
        template: '#list_anotaciones-template',
        data(){
            return {
                credito : {!! $credito !!},
                anotaciones2 : [],
                anotaciones  : [],
                pag : {
                    num_regi_pag :10,
                    paginas : 0,
                    registros : 0,
                    pagina_actual : 1
                }
            }
        },
        methods:{
            async getAnotaciones(){

                var self = this

                this.actionPaginate(1)

                if(this.credito.proceso){
                    let res = await axios.get('/admin/anotaciones/'+this.credito.proceso.id+'/list')
     
                    if( !res.data.error ){
                        self.anotaciones = res.data.dat
                        self.paginacion()
                    } else {
                        alert(res.data.message)
                    }

                }
            },
            show(anotacion){
                Bus.$emit('showAnotacion', anotacion)
            },
            editar(anotacion){
                Bus.$emit('editarAnotacion', anotacion)
            },
            paginacion(){
                this.pag.registros = this.anotaciones.length
                this.pag.paginas = Math.ceil(this.pag.registros/this.pag.num_regi_pag)

                var x = this.pag.pagina_actual * this.pag.num_regi_pag
                var ini = x - this.pag.num_regi_pag
                var fin = x
                this.anotaciones2 = this.anotaciones.slice(ini, fin) 
            },
            actionPaginate(action){
                if(action == 'next'){

                    
                    if(this.pag.pagina_actual + 1 <= this.pag.paginas){
                        this.pag.pagina_actual ++
                        var x =  this.pag.pagina_actual * this.pag.num_regi_pag
                        var ini = x - this.pag.num_regi_pag
                        var fin = x
                        this.anotaciones2 = this.anotaciones.slice(ini, fin) 
                    }
                } else if(action == 'previus'){
                    
                    if(this.pag.pagina_actual - 1 >= 1){
                        this.pag.pagina_actual --
                        var x =  this.pag.pagina_actual * this.pag.num_regi_pag
                        var ini = x - this.pag.num_regi_pag
                        var fin = x
                        this.anotaciones2 = this.anotaciones.slice(ini, fin) 
                    } 
                } else {
                    this.pag.pagina_actual = action
                    var x =  this.pag.pagina_actual * this.pag.num_regi_pag
                    var ini = x - this.pag.num_regi_pag
                    var fin = x
                    this.anotaciones2 = this.anotaciones.slice(ini, fin) 
                }
            }
        },  
        created(){
            var self = this

            this.getAnotaciones()
            this.paginacion()

            Bus.$on('getAnotaciones', function(){
                self.getAnotaciones()
            })
        }
    })

</script>