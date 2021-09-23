<div class="modal fade" tabindex="-1" role="dialog" id="descuento">
    <div class="modal-dialog modal-lg" role="document" id="descuento-template">
        <div class="modal-content">
        <div class="modal-header my-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="display:initial;">
                <span style="text-transform:capitalize"></span> Descuento a Crédito
            </h4>
        </div>
        <div class="modal-body">
            <div class="row" style="padding:0px 30px;">
                <div class="col-md-6">
                    <form @submit.prevent="generate">
                        <div class="form-group">
                            <label>Monto *</label>
                            <input 
                                type="numeric"
                                class="form-control"
                                v-model="descuento.monto"
                            >
                            <p class="help-block">Agregue el monto para el descuento.</p>
                        </div>
                        <div class="form-group">
                            <label>Descripción *</label>
                            <textarea 
                                class="form-control" 
                                rows="5" 
                                v-model="descuento.descripcion"
                            ></textarea>
                            <p class="help-block">Se requieren los detalles del descuento.</p>
                        </div>
                        @permission('descuento')
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >Generar</button>
                        @endpermission
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cant</th>
                                    <th>Concepto</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="conceptoDescuento in conceptosDescuento">
                                    <td>@{{ conceptoDescuento.cant }}</td>
                                    <td>@{{ conceptoDescuento.concepto }}</td>
                                    <td>@{{ conceptoDescuento.subtotal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <center>
                            <button class="btn btn-primary" @click="descontar">
                                Descontar
                            </button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>
        </div>
    </div>
</div>

<script>
    const descuentoComponent = new Vue({
        el: "#descuento-template",
        data: {
            credito_id: {!! $precredito->credito->id !!},
            descuento: {
                monto: '',
                descripcion: '',
            },
            conceptosDescuento: []
        },
        methods: {
            generate() {
                if (!this.descuento.monto) {
                    alertify.alert('Error', 'Se requiere el monto');
                }

                let self = this;

                axios.post("/start/facturas/abonos", {
                    credito_id: this.credito_id,
                    monto: this.descuento.monto,
                })
                .then( res => {
                    console.log({res});
                    if (res.data.success) {
                        self.conceptosDescuento = res.data.dat;
                    } else {
                        alertify.alert("Error", res.data.message);
                    }
                })
                .catch( error => {
                    alertify.alert("Error", error.message());
                    console.error(error);
                })
            },
            descontar() {
                let data = {
                    credito_id: this.credito_id,
                    monto: this.descuento.monto,
                    descripcion: this.descuento.descripcion,
                    conceptosDescuento: this.conceptosDescuento,
                };

                axios.post("/api/descuentos", data)
                    .then( res => {
                        console.log({res});
                    })
                    .catch( error => {
                        alertify.alert("Error", error.message());
                        console.error(error);
                    });
            }
        }
    });    
</script>

<style scope>
    .panel-acuerdo {
        height:320px;
        overflow: scroll;
    }

    .acuerdo_box {
        padding: 11px;
    }
    .success_box {
        background: #d5e2d5;
    }
    .danger_box {
        background: #e8c6c6;
    }

</style>