<script type="text/x-template" id="config_pagos-template">
   
    <div class="modal fade" id="modal_config_pagos" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Configuración de pagos</h4>
            </div>
            <div class="modal-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Carteras</label>
                        <select id="cartera" class="form-control" @change="addCartera()"
                            v-model="cartera">
                            <option disabled selected>--</option>
                            <option value="all">TODAS LAS CARTERAS</option>
                            <option v-for="cartera in carteras" v-text="cartera.nombre"
                                :value="cartera"></option>
                        </select>
                    </div>    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Porcentaje</label>
                        <input type="number" class="form-control" v-model="porcentaje" 
                            v-on:keyup="addPorcentaje">
                    </div>    
                </div>
            </div>

            <div class="row" v-if="arr_carteras">
                <div class="col-md-12">
                    <p v-for="cartera in arr_carteras">
                        <a href="">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                            @{{cartera.nombre}} 
                            <span v-if="cartera.porcentaje_pago_parcial > 0">
                                - @{{cartera.porcentaje_pago_parcial}}% PAGO 
                            </span>
                            <span v-else>
                                - 0% PAGO 
                            </span>
                    </p>
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" @click="reset">Borrar Todo</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" @click="setPorcentajePagoParcial">Salvar Cambios</button>
            </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</script>


<script>
    Vue.config.devtools = true

    Vue.component('config_pagos-component',{
        template: '#config_pagos-template',
        data(){
            return {
                carteras : {!! json_encode($carteras) !!},
                arr_carteras : [],
                cartera : {},
                porcentaje: ''
            }
        },
        methods : {
            addCartera(){

                var self = this;

                if (this.cartera == 'all') {

                    this.arr_carteras = JSON.parse(JSON.stringify(this.carteras));

                } else {

                    var exist = false;

                    this.arr_carteras.forEach( cartera => {
                        if(cartera.id == self.cartera.id)
                            exist = true;
                    });

                    console.log(exist);

                    if(!exist){
                        this.arr_carteras.push(this.cartera);
                    }

                }

            },
            addPorcentaje(){

                var self = this;

                if ( this.porcentaje.length > 0 && this.porcentaje > 0 && this.porcentaje <= 100) {
                    this.arr_carteras.forEach( cartera => {
                        cartera.porcentaje_pago_parcial = self.porcentaje;
                    });
                } else {

                    alert('Lo sentimos, el porcentaje debe estar enter 1 y 100');

                    this.porcentaje = '';
                }
            },
            setPorcentajePagoParcial(){

                var self = this;

                if(!this.validate()){
                    return false;
                }

                if(!confirm('¿Esta seguro de este cambio?')){
                    return false;
                }


                axios.post('/admin/variables/pagos/set_porcentaje_pago_parcial', {
                    carteras: self.arr_carteras
                }).then( res => {
                    if(res.data.success){
                        //cargar nuevamente las carteras
                        //mostrar mensaje satisfactorio
                    } else {
                        // mostrar el error
                    }
                })
            },
            reset(){
                this.arr_carteras = [];
                this.cartera = '';
                this.porcentaje = '';
            },
            validate(){
                if(this.arr_carteras.length > 0){
                    if(this.porcentaje.length > 0 ){
                        if(this.porcentaje.length > 0 && this.porcentaje > 0 && this.porcentaje <= 100){
                            return true;
                        } else {
                            alert('Se requiere un valor entre 1 y 100');
                            return false;
                        }
                    } else {
                        alert('Digite un valor válido para el porcentaje');
                        return false;
                    }
                } else {
                    alert('Se requiere por lo menos una cartera');
                    return false;
                }
            }
        },
        created(){
            Bus.$on('show_modal_config_pagos', ()=>{
                $('#modal_config_pagos').modal('show');
            })
        }
    });
</script>