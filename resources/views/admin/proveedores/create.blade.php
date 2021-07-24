<div id="form">
    <div class="form-group top-min">
        <label for="nombre">Nombre o razon social</label>
        <input type="text" class="form-control input-small"
               v-model="proveedor.nombre">
    </div>
    <div class="form-group top-min" v-if="estado == 'edit'">
        <label for="estado">Estado</label>
        <select class="form-control input-small" v-model="proveedor.estado">
            <option selected disabled>--</option>
            <option :value="element" v-for="element in estados"
                >@{{ element }}</option>
        </select>
    </div>
    <div class="form-group top-min">
        <label for="tipo_doc">Tipo documento</label>
        <select class="form-control input-small" v-model="proveedor.tipo_doc">
            <option selected disabled>--</option>
            <option :value="element" v-for="element in tipo_doc">@{{ element }}</option>
        </select>
    </div>
    <div class="form-group top-min">
        <label for="nombre">Número de documento</label>
        <input type="text" class="form-control input-small"
               v-model="proveedor.num_doc">
    </div>
    <div class="form-group top-min">
        <label for="nombre">Teléfono</label>
        <input type="text" class="form-control input-small"
               v-model="proveedor.telefono">
    </div>
    <div class="form-group top-min">
        <label for="nombre">Dirección</label>
        <input type="text" class="form-control input-small"
               v-model="proveedor.direccion">
    </div>
    <br>
    <button class="btn btn-default" v-if="estado == 'create'" @click="create()">Crear</button>
    <button class="btn btn-default" v-else @click="update()">Guardar Cambios</button>
</div>


<script>
    var Bus = new Vue()

    var form = new Vue({
        el:'#form',
        data:{
            estados : {!! json_encode($estados) !!},
            tipo_doc: {!! json_encode($tipo_doc) !!},
            proveedor: {
                id        : '',
                nombre    : '',
                tipo_doc  : '',
                num_doc   : '',
                telefono  : '',
                direccion : '',
                estado    : ''
            },
            estado : ''
        },
        methods:{
            create(){
                var self = this
                if(!this.validate()) {
                    return false
                }
                if(!confirm('Esta segur@ de crear el proveedor?'))
                {
                    return false
                }
                axios.post('proveedores', {proveedor:this.proveedor})
                    .then(function(res){
                        alert(res.data.message)
                        if(!res.data.error){
                            self.reset()
                            Bus.$emit('getProveedores')
                        }                        
                    })
            },
            getProveedor(proveedor_id){
                var self = this
                axios.get('proveedores/'+proveedor_id+'/edit')
                    .then(function(res){
                        if(res.data.error){
                            alert(res.data.message)
                        } else {
                            self.proveedor = res.data.dat
                        }
                    })
            },
            update(){
                var self = this
                axios.put('proveedores/'+this.proveedor.id, {proveedor:this.proveedor})
                    .then(function(res){
                        console.log('update',res.data)
                        
                    })

            },
            validate(){
                var string = ''

                if(this.proveedor.nombre == ''){
                    string += 'El nombre o razón social son requeridos\n'
                }

                if(string != ''){
                    alert(string)
                    return false
                }
                return true
            },
            reset(){
                this.proveedor = ''
            }
        },
        created(){
            var self = this
            this.estado = 'create'
            Bus.$on('edit',function(proveedor_id){
                self.getProveedor(proveedor_id)
                self.estado = 'edit'
            })
        }
    })

</script>