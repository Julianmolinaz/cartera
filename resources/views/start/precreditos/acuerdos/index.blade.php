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
                            <p class="help-block">Agregue la fecha en la que hará el pago.</p>
                        </div>
                        <div class="form-group">
                            <label>Descripción *</label>
                            <textarea class="form-control" rows="5" v-model="acuerdo.descripcion"></textarea>
                            <p class="help-block">Se requieren los detalles del acuerdo de pago.</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Estado</label>
                            <select class="form-control" v-model="acuerdo.estado">
                                <option :value="estado" v-for="estado in estados">@{{estado}}</option>
                            </select>
                            <p class="help-block">Puede cerrar o abrir el estado del acuerdo.</p>
                        </div>
                        @permission('crear_acuerdo')
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        @endpermission
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default" style="margin-top:20px;">
                   
                        <div class="panel-body panel-acuerdo">
                            <dl v-for="acuerdo in acuerdos" 
                                :class="['acuerdo_box', (acuerdo.estado == 'Abierto') ? 'success_box' : 'danger_box']" 
                                >

                                <dt>@{{acuerdo.id}}- Acuerdo (@{{acuerdo.estado}}) 

                                    @permission('eliminar_acuerdo')
                                    <a  
                                        href="javascript:void(0);"
                                        style="float:right;"
                                        @click="deleteAcuerdo(acuerdo)"
                                        href="{{route('start.creditos.destroy',$precredito->credito->id)}}"
                                        class="btn btn-danger btn-xs float-right"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Eliminar Acuerdo"> Eliminar
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>  
                                    @endpermission
                                    @permission('editar_acuerdo')
                                    <a  
                                        href="javascript:void(0);"
                                        style="float:right;margin:0 5px;"
                                        @click="edit(acuerdo)"
                                        href="{{route('start.creditos.destroy',$precredito->credito->id)}}"
                                        class="btn btn-primary btn-xs float-right"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Editar Acuerdo"> Editar
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>   
                                    @endpermission 
                                </dt>
                                <dd v-if="acuerdo.fecha != '0000-00-00'">Fecha: @{{acuerdo.fecha}}</dd>
                                --------------
                                <dd>@{{acuerdo.descripcion}}</dd>
                                --------------
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

                axios.get('/start/acuerdos/'+ {!! json_encode($precredito->credito->id) !!})
                    .then( res => {
                        self.acuerdos = res.data;
                    })
            },
            deleteAcuerdo(acuerdo) {

                var self = this;

                alertify.confirm('Confirmar', '¿Esta seguro de borrar el acuerdo?', 
                function () {
                    axios.get(`/start/acuerdos/${acuerdo.id}/delete`)
                        .then( res => {
                            if (res.data.success) {
                                alertify.notify(res.data.message, 'success', 5);
                                self.acuerdos = res.data.dat;
                            } else {
                                alertify.alert('Ocurrió un error', res.data.message, function(){ alertify.success('Ok'); });
                            }
                        });
                }
                ,function(){ alertify.error('Se ha cancelado la eliminación')});

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