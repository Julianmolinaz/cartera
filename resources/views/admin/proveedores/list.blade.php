
<div id="list">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Tipo doc.</th>
                <th>Documento</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr class="tbl_min" v-for="proveedor in proveedores">
                <td v-text="proveedor.nombre"></td>
                <td v-text="proveedor.estado"></td>
                <td v-text="proveedor.tipo_doc"></td>
                <td v-text="proveedor.num_doc"></td>
                <td v-text="proveedor.telefono"></td>
                <td v-text="proveedor.direccion"></td>
                <td>
                    <a href="#" class='btn btn-default btn-xs' title="Editar"
                        @click="edit(proveedor.id)">
                        <span class = "glyphicon glyphicon-pencil"></span>
                    </a> 
                    <a href="#" class='btn btn-default btn-xs' title="Eliminar">
                        <span class = "glyphicon glyphicon-trash" ></span>
                    </a>  
                </td>
            </tr>
        </tbody>
    </table>  

</div>

<script>
    var list = new Vue({
        el:'#list',
        data:{
            proveedores: ''
        },
        methods:{
            getProveedores(){
                var self = this
                axios.get('proveedores/list')
                    .then(function(res){
                    if(res.data.error){
                        alert(res.data.message)
                    }
                    else {
                        self.proveedores = res.data.dat
                    }
                })
            },
            edit(proveedor_id){
                Bus.$emit('edit',proveedor_id)
            }
        },
        created(){
            var self = this
            this.getProveedores()
            Bus.$on('getProveedores', function(){
                self.getProveedores()
            })
        }
    })
</script>