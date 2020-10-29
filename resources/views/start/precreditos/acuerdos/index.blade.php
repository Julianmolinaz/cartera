<div class="modal fade" tabindex="-1" role="dialog" id="acuerdo">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header my-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Acuerdo de pago</h4>
        </div>
        <div class="modal-body">
            <div class="row" style="padding:0px 30px;">
                <div class="col-md-6">
                    <form @submit.prevent="onSubmit">
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="date" class="form-control" v-model="acuerdo.fecha">
                        </div>
                        <div class="form-group">
                            <label>Descripción *</label>
                            <textarea class="form-control" rows="5" v-model="acuerdo.descripcion"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Estado</label>
                            <select class="form-control" v-model="acuerdo.estado">
                                <option :value="estado" v-for="estado in estados">@{{estado}}</option>
                            </select>
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default" style="margin-top:20px;">
                   
                        <div class="panel-body" style="height:320px;overflow: scroll;">
                            <dl v-for="acuerdo in acuerdos" style="cursor:pointer;" @click="edit()">
                                <dt>Acuerdo</dt>
                                <dd>@{{acuerdo.fecha +' / '+ acuerdo.estado + ' / '+  acuerdo.descripcion}}</dd>
                                <hr>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    class Acuerdo {
        constructor() {
            this.fecha = {!! json_encode(\Carbon\Carbon::now()->format('Y-m-d')) !!};
            this.descripcion = '';
            this.estado = 'Abierto';
            this.credito_id = {!! json_encode($precredito->credito->id) !!}
        }
    }

    const acuerdo = new Vue({
        el: '#acuerdo',
        data: {
            estados: ['Abierto','Cerrado'],
            acuerdo: new Acuerdo(),
            status: 'crear',
            acuerdos: {!! json_encode($precredito->credito->acuerdos) !!}
        },
        methods: {
            async onSubmit() {
                const res = await axios.post('/start/acuerdos',this.acuerdo);
                if (res.data.success) {
                    alertify.notify(res.data.message, 'success', 5, function(){  console.log(''); });
                    this.acuerdos = res.data.dat;
                }
            }
        }
    });

</script>
