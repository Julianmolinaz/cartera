
<div id="list_egresos">


        <h3 style="margin:4px 4px;display:inline-block">
            <span class="glyphicon glyphicon-pawn"></span>
            Egresos <button class="btn btn-default btn-xs" @click="exportar()">Exportar</button>
        </h3>
        <div  style="display:inline-block;float:right;margin-top:10px">
            <button class="btn btn-default btn-xs" @click="search()">Buscar</button>
        </div>
        <div style="display:inline-block; float:right;margin-top:10px;">
            <input type="text" class="form-control input-small" v-model="string" v-on:keyup.13="search()">
        </div>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Comp</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Punto</th>
                <th>Valor</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr class="tbl_min" v-for="egreso in egresos">
                <td>@{{ egreso.comprobante_egreso }}</td>
                <td>@{{ egreso.fecha }}</td>
                <td>@{{ egreso.concepto }}</td>
                <td>@{{ egreso.punto.nombre }}</td>
                <td>@{{ egreso.valor }}</td>
                <td>
                    <a href="#" class="btn btn-default btn-xs"  @click="show_egreso(egreso)">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a href="#" class="btn btn-default btn-xs" @click="dropEgreso(egreso.id)">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>
        </tbody>
 
    </table>

    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm">
            <li v-if="pagination.current_page > 1">
                <a href="#" aria-label="Previous"
                    @click.prevent="change_page(pagination.current_page - 1 )">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]">
                <a href="#" @click.prevent="change_page(page)">@{{page}}</a>
            </li>
            <li v-if="pagination.current_page < pagination.last_page">
                <a href="#" aria-label="Next" @click.prevent="change_page(pagination.current_page + 1 )">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    @include('start.egresos.show_modal')

</div>
<script>

var list_egresos = new Vue({
    el:"#list_egresos",
    data:{
        egreso : '',
        egresos: '',
        string : null,
        status : 'inicial', //inicial : carga de todos los egresos
                          //filtrado : carga de egresos filtrados
        pagination : {
            total        : 0,
            current_page : 0,
            per_page     : 0,
            last_page    : 0,
            from         : 0,
            total        : 0,
            to           : 0
        },
        offset : 2
    },
    methods:{
        get_egresos(page){
            var self = this
            this.status = 'inicial'
            axios.get('egresos/get_egresos?page='+page)
                .then(function(res){
                    console.log('list',res.data.dat.data)
                    if(!res.data.error) {
                        self.egresos = res.data.dat.data
                        self.pagination = res.data.pagination
                    }
                })
        },
        show_egreso(egreso){
            console.log('egreso', egreso);
            this.egreso = egreso
            $('#show_modal').modal('show')
        },
        search(page = 1){
            var self = this
            this.status = 'filtrado'
            axios.get('egresos/search/' + this.string+'?page='+page)
                .then(function(res){
                    self.egresos = res.data.dat.data
                    self.pagination = res.data.pagination
                })
        },//.search()
        change_page(page){
            this.pagination.current_page = page

            if(this.status == 'inicial')
                this.get_egresos(page)
            else 
                this.search(page)
        },
        dropEgreso(egreso_id){ 

            var self = this

            if(! confirm('Esta seguro de eliminar el registro ?')){
                return false
            }
            axios.get('egresos/'+egreso_id+'/destroy')
                .then(function(res){
                    alert(res.data.message)
                    if (!res.data.error) {
                        self.get_egresos()
                    }
                })
        },
        exportar(){
            window.open('/start/egresos_report', '_blank');
        }
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page
        },
        pagesNumber: function(){
            if(!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset
            if(from < 1) { from = 1 }

            var to = from + (this.offset * 2)
            if( to >= this.pagination.last_page ) {
                to = this.pagination.last_page
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from)
                from++
            }

            return pagesArray
        }
    },
    created(){
        var self = this
        this.get_egresos()
        Bus.$on('get_egresos', function(){
            self.get_egresos()
        })
    }
})

</script>