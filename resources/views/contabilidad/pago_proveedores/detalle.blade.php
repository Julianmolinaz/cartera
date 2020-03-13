<script type="text/x-template" id="detalle-template">
    <div class="row">
        
        <div class="col-sm-6">
            <div class="alert alert-dismissible alert-primary">
                <strong>Total</strong>
                <strong>@{{ total }}</strong>
            </div>    
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-success" @click="pagar">Pagar al Proveedor</button>
        </div>
           
        <div class="col-sm-12">
            <h5>Productos en debe</h5>
            <table class="table table-hover" style="font-size:10px">
                <thead>
                    <tr>
                        <th>Acción</th>
                        <th>Crédito</th>
                        <th>Estado</th>
                        <th>Producto</th>
                        <th>Producto en la solicitud</th>
                        <th>Num. Factura</th>
                        <th>Costo</th>
                        <th>Iva</th>
                        <th>Check</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) in items">
                        <td>
                            <button type="button" class="btn btn-outline-info btn-sm" @click="show(item)">Ver</button>
                        </td>
                        <td>@{{ (item.credito_id) ? 'C-'+item.credito_id : 'S-'+item.precredito_id}}        </td>
                        <td>@{{item.estado}}    </td>
                        <td>@{{item.nombre}}    </td>
                        <th>@{{item.producto_solicitud}}</th>
                        <td>@{{item.num_fact}}  </td>
                        <td>@{{item.costo}}     </td>
                        <td>@{{item.iva}}       </td>
                        <td>
                            <input type="checkbox" class="form-control" @click="analizar($event,index)">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @include('contabilidad.pago_proveedores.edit_ref_product')
    </div>
</script>

<script src="/js/interfaces/filters.js"></script>
<script src="/js/vue/vee_es.js"></script>


<script>
    Vue.use(VeeValidate);
    VeeValidate.Validator.localize("es");

    Vue.component('detalle-component',{
        template : '#detalle-template',
        data(){
            return {
                proveedores : {!! json_encode($proveedores) !!},
                items : [],
                total : 0,
                proveedor: '',
                item  : ''
            }
        },
        methods: {
            analizar(event,index){
                this.items[index].checked = !this.items[index].checked;
                if(event.toElement.checked){
                    this.total += this.items[index].costo; 
                } else {
                    this.total -= this.items[index].costo; 
                }
            }, 
            show(item){
                $('#modal').modal('show');
                this.item = item;
            },
            onSubmit(){
                var self = this;
        
                this.$validator.validate()
                .then( validate => {
                    if(validate){
                        self.send();
                    } else {
                        alert('Por favor complete correctamente todos los campos requeridos.');
                    }
                })    
            },
            send(){

                var self = this;

                axios.post('/ref_productos',this.item)
                    .then( res => {
                        alert(res.data.message);

                        if(res.data.success){
                            $('#modal').modal('hide'); 
                            self.items = [];
                            Bus.$emit('getDetalles');     
                        } else {
                            console.log(res.data.dat);
                        }

                    })
            },
            pagar(){
                axios.post('/ref_productos/pagar',this.items)
                    .then( res => {
                        alert(res.data.message);

                        if(res.data.success){
                            self.items = [];
                            Bus.$emit('getDetalles');  
                        } else {
                            console.log(res.data.dat);
                        }
                    })
            }
        },
        filters: {
            miles(value) {
                if(value)
                    return '$ '+formatVue(value);
                else 
                    return '';
            }
        },
        created(){

            var self = this;

            Bus.$on('showDetalles',function(data){
                self.items = data.items;
                self.proveedor = data.proveedor
            });
        }
    });
</script>

<style scoped>
  ._has-error {
    border-color: red;
  }

</style>