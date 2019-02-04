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
    <div class="col-md-9">
        <template  v-if="cajas.length > 0">
            
            <table class="table table-condensed" id="cajas">
                <thead>
                    <tr>
                        <th>Sucursal</th>
                        <th>Funcionario</th>
                        <th>Llamadas</th>
                        <th>Solicitudes</th>
                        <th>Abonos</th>
                        <th>Estudios</th>
                        <th>Iniciales</th>
                        <th>Total Caja</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(caja, index) in cajas">
                        <td>@{{ caja.punto.nombre }}</td>
                        <td>@{{ caja.user.name  }}</td>
                        <td>@{{ caja.num_calls }}</td>
                        <td>@{{ caja.num_precreditos }}</td>
                        <td>@{{ caja.total_abonos }}</td>
                        <td>@{{ caja.total_estudios }}</td>
                        <td>@{{ caja.total_iniciales }}</td>
                        <td>@{{ caja.total_caja }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </template>
    </div>
</div>


<script>

  

  var Bus = new Vue();
  
  var vm = new Vue({
    el:"#principal",
    data:{
      cajas : [],
      date  : '',
      date_real: ''
    },
    methods:{
        get_cashes_report:function() {
            if(! this.date){ return true; }
            var self = this
            var route = "/start/all_cajas/report/" + this.date

            axios.get(route).then(
                function (res) {
                    if (! res.error) {
                        self.cajas = res.data.dat
                    } else {
                        alert(res.data.message)
                    }
                })
        }
    },//.methods
    mounted(){
        this.date = moment().format('YYYY-MM-DD')
        this.get_cashes_report()
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