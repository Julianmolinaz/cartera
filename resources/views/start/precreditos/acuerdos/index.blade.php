<div class="modal fade" tabindex="-1" role="dialog" id="acuerdo">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header my-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" style="display:initial;"><span style="text-transform:capitalize">@{{status}}</span> Acuerdo de Pago</h4>
            <button class="btn btn-success" style="margin-left:20px;" v-if="status=='editar'" @click="changeToCreate">Crear</button>
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
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default" style="margin-top:20px;">
                   
                        <div class="panel-body" style="height:320px;overflow: scroll;">
                            <dl v-for="acuerdo in acuerdos" style="cursor:pointer;" @click="edit(acuerdo)">
                                <dt>Acuerdo (@{{acuerdo.estado}})</dt>
                                <dd v-if="acuerdo.fecha != '0000-00-00'">Fecha: @{{acuerdo.fecha}}</dd>
                                <dd>@{{acuerdo.descripcion}}</dd>
                                <dd style="font-size:0.7em;">Creó: @{{acuerdo.creator.name+' :: '+acuerdo.created_at}}</dd>
                                <dd v-if="acuerdo.updator" style="font-size:0.7em;">Actualizó: @{{acuerdo.updator.name+' :: '+acuerdo.updated_at}}</dd>
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
            acuerdos: ''
        },
        methods: {
            onSubmit() {
                if (this.status == 'crear') this.create();
                else this.update();
            },
            getAcuerdos() {

                var self = this;

                axios.get('/start/acuerdos/'+{!! json_encode($precredito->credito->id) !!})
                    .then( res => {
                        self.acuerdos = res.data;
                    })
            },
            async create() {
                const res = await axios.post('/start/acuerdos',this.acuerdo);
                if (res.data.success) {
                    alertify.notify(res.data.message, 'success', 5, function(){  console.log(''); });
                    this.acuerdos = res.data.dat;
                    this.changeToCreate();
                }
            },
            async update() {
                const res = await axios.put('/start/acuerdos/'+this.acuerdo.id,this.acuerdo);
                if (res.data.success) {
                    alertify.notify(res.data.message, 'success', 5, function(){  console.log(''); });
                    this.acuerdos = res.data.dat;
                    this.changeToCreate();
                }
            },
            edit(acuerdo) {
                this.status = 'editar';
                this.acuerdo = JSON.parse(JSON.stringify(acuerdo));
            },
            changeToCreate() {
                this.status = 'crear';
                this.acuerdo = new Acuerdo();
            }
        },
        created() {
            this.getAcuerdos();
        }
    });

</script>
