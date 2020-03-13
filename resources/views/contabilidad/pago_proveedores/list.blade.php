<script type="text/x-template" id="pago_proveedores-template">
    <div>
        <h5>Proveedores en debe</h5>
        <table class="table table-hover" style="font-size:10px">
            <thead>
                <tr>
                    <th>Proveedor</th>
                    <th>Debe</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="proveedor in proveedores">
                    <td>@{{proveedor.razon_social}}</td>
                    <td>@{{proveedor.debe}}</td>
                    <td><a class="btn btn-outline-primary btn-sm" @click="getDetalles(proveedor,'debe')">Debe</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</script>

<script>
    Vue.component('pago_proveedores-component',{
        template: '#pago_proveedores-template',
        props : ['proveedores'],
        data: {
            proveedor: '',
            type: ''
        },
        methods:{
            getDetalles(proveedor,type){

                this.proveedor = proveedor;
                this.type = type;

                axios.get('/contabilidad/pago_proveedores/'+proveedor.id+'/'+type)
                    .then( res => {
                        Bus.$emit('showDetalles', {items: res.data.dat, proveedor});
                    });
            }
        },
        created(){

            var self = this;

            Bus.$on('getDetalles', function(){
                self.getDetalles(self.proveedor,self.type);
            });
        }
    });
</script>