@section('title','Reportes')
@section('contenido')

<div class="row" id="principal">
    <div class="col-md-3">
        <ul class="list-group">

            <li class="list-group-item">

            <div class="form-group has-info has-feedback"  style="margin-bottom:0px;">
                <label class="control-label" for="inputSuccess2">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                Reporte cajas <template v-if="cajas.length > 0">@{{ cajas[0].date }}</template></label>
            </div>
            </li>
            <li class="list-group-item">

            <div class="form-group has-info has-feedback">
                <label class="control-label" for="inputSuccess2">Fecha de reporte</label>
                <input type="date" class="form-control" v-model="date" id="date">
                <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true">
                </span>
            </div>
            <a href="#" class="btn btn-primary btn-xs" @click="get_cashes_report">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                Generar reporte
            </a>
            <a href="#" class="btn btn-danger btn-xs" id="btn_exportar">
                <span class="glyphicon glyphicon-export" aria-hidden="true"></span>
                Exportar CSV
            </a>
            </li>

        </ul>
    </div>
    <div class="col-md-3" style="padding-right: 48px;">
        <template >

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group col-md-2">
                        <label for="">...</label>
                        <div class="checkbox">
                        <label>
                            <input type="checkbox" :checked="solo_pagos" @click="onlyPagos"> 
                            Solo pagos
                        </label>
                    </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Sucursal</label>
                        <select class="form-control" v-model="punto_id" @change="filterPuntos">
                            <option value="" selected>--</option>
                            <option :value="punto.id" v-for="punto in puntos">@{{ punto.nombre }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Funcionarios</label>
                        <select class="form-control" v-model="user_id" @change="filterUsuario">
                            <option value="" selected>--</option>
                            <option :value="user.id" v-for="user in users">@{{ user.name }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3" style="margin-top: 25px;">
                        <a href="javascript:void(0);" class="btn btn-primary" @click="reset">Reset</a>
                    </div>
        
                </div>
            
            </div>
                <table class="table table-condensed" id="cajas" 
                    style="font-size:10px;">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Funcionario</th>
                            <th>Llamadas</th>
                            <th>Solicitudes</th>
                            <th>Abonos</th>
                            <th>Descuentos</th>
                            <th>Otros Pagos</th>
                            <th>Estudios</th>
                            <th>Iniciales</th>
                            <th>Egresos</th>
                            <th>Total Caja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(caja, index) in cajas">
                            <td>@{{ caja.punto.nombre }}</td>
                            <td>@{{ caja.user.name  }}</td>
                            <td align="right">@{{ caja.num_calls }}</td>
                            <td align="right">@{{ caja.num_precreditos }}</td>
                            <td align="right">@{{ new Intl.NumberFormat("de-DE").format(caja.total_abonos) }}</td>
                            <td align="right">@{{ new Intl.NumberFormat("de-DE").format(caja.total_descuentos) }}</td>
                            <td align="right">@{{ new Intl.NumberFormat("de-DE").format(caja.total_otros_pagos) }}</td>
                            <td align="right">@{{ new Intl.NumberFormat("de-DE").format(caja.total_estudios) }}</td>
                            <td align="right">@{{ new Intl.NumberFormat("de-DE").format(caja.total_iniciales) }}</td>
                            <td align="right">@{{ new Intl.NumberFormat("de-DE").format(caja.total_egresos) }}</td>
                            <td align="right">@{{ new Intl.NumberFormat("de-DE").format(caja.total_caja) }}</td>
                        </tr>
                        <tr >
                            <td colspan="2" style="font-size:16px;">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2" style="font-size:16px;" align="right">$ @{{new Intl.NumberFormat("de-DE").format(ttal)}}</td>
                        </tr>
                    </tbody>
                </table>
            
        </template>
    </div>
</div>


<script>

Vue.config.devtools = true;

  var Bus = new Vue();
  
  var vm = new Vue({
    el:"#principal",
    data:{
        solo_pagos: false,
        user_id   : '',
        users     : [],
        cajas     : [],
        punto_id  : '',
        date      : '',
        date_real : '',
        puntos    : [],
        cajas_originales: [],
        ttal     : 0
    },
    methods:{
        get_cashes_report: async function() {
            if( !this.date ) return true; 

            var route = "/start/all_cajas/report/" + this.date

            var res = await axios.get(route);

            if (! res.data.error) {
                this.cajas = res.data.dat.cajas;
                this.cajas_originales = res.data.dat.cajas;
                this.puntos = res.data.dat.puntos;
                this.users  = res.data.dat.users;
                await this.onlyPagos();
                await this.total();
            } else {
                alert(res.data.message);
            }
        },
        onlyPagos() {

            this.solo_pagos = !this.solo_pagos;
            
            if (this.solo_pagos) {

                this.cajas = this.cajas_originales.filter( element => {
                    return element.total_caja > 0;               
                })
            } else {
                this.cajas = JSON.parse(JSON.stringify(this.cajas_originales));
            }
            this.total();
        },
        filterPuntos(){
            var self = this;
            this.cajas = this.cajas_originales.filter( element => {
                return element.punto.id == self.punto_id
            });

            this.total();
            this.user_id = '';
        },
        filterUsuario(){
            var self = this;
            this.cajas = this.cajas_originales.filter( element => {
                return element.user.id == self.user_id
            });

            this.total();
            this.punto_id = '';
        },
        async reset() {
            this.user_id = '';
            this.punto_id = '';
            this.cajas = this.cajas_originales;
            this.solo_pagos = false;
            await this.onlyPagos();
            await this.total();
        },
        total() {
            this.ttal = 0;

            this.cajas.forEach( element => {
                this.ttal += element.total_caja;
            });
        }
    },//.methods
    async mounted(){
        this.date = moment().format('YYYY-MM-DD')
        await this.get_cashes_report()
    }
  })


    $('#btn_exportar').click(function(){
        var date = $('#date').val();
        $('#cajas').table2excel({
            name: 'Reporte',
            filename: "repor_caja_"+ vm.cajas[0].date +".xls"
        });
    });



</script>

@endsection
@include('templates.main2')