<script>
	Vue.component('reporte-component',{
		template:`
			<div>
				 <ul class="list-group">

			     <li class="list-group-item">

			        <div class="form-group has-info has-feedback"  style="margin-bottom:0px;">
			          <label class="control-label" for="inputSuccess2">
			          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
			          @{{ (info.punto) ? info.punto.nombre : '' }}@{{' '+info.date}}</label>
					  <br>
					  <label>Ventas mes: @{{ventas}}</label>
			        </div>
			      </li>
			      <li class="list-group-item">

			        <div class="form-group has-info has-feedback">
			          <label class="control-label" for="inputSuccess2">Fecha de reporte</label>
			          <input type="date" class="form-control" v-model="date">
			          <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true">
			          </span>
			        </div>
			        <a href="#" class="btn btn-primary btn-xs" @click="get_cash_report()">
			        	<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						Generar reporte
			        </a>
			      </li>

			    </ul>
			    
			    <ul class="list-group">

			      <li class="list-group-item">
			        <center>
			          <h4>Reporte Caja </h4>
			        </center>
			      </li>
				  <li class="list-group-item">
			        <span class="badge">@{{ info.num_anuladas }}</span>
			        <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			        Anuladas
			      </li>
			      <li class="list-group-item">
			        <span class="badge">@{{ info.num_calls }}</span>
			        <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			        Llamadas
			      </li>
			      <li class="list-group-item">
			        <span class="badge">@{{ info.num_precreditos }}</span>
			        <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			        Solicitudes
			      </li>
			       <li class="list-group-item">
			          <span class="badge">@{{ info.total_abonos }}</span>
			          <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			          Abonos
			        </li>
			        <li class="list-group-item">
			          <span class="badge">@{{ info.total_estudios }}</span>
			          <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			          Estudios
			        </li>
			        <li class="list-group-item">
			          <span class="badge">@{{ info.total_iniciales }}</span>
			          <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			          Iniciales
			        </li>
							<li class="list-group-item">
			          <span class="badge">@{{ info.total_egresos }}</span>
			          <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			          Egresos
			        </li>
			        <li class="list-group-item">
			          <span class="badge">@{{ info.total_caja }}</span>
			          <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			          Total caja
					</li>
					
					@{{date}}

			    </ul>
			</div>
		`,
		data(){
			return {
				date: '',
				info: '',
				ventas: 0
			}
		},
		methods: {
			get_cash_report:function() {
				var self = this
				var route = "/start/cajas/report/" + this.date

				axios.get(route).then(
					function (res) {
						console.log(res)
						if (! res.error) {
							self.info = res.data.dat
							self.getVentasMes();
							Bus.$emit('get_dat', res.data.dat)
						} else {
							alert(res.data.message)
						}
					})
			}, 
			getVentasMes() {
				var self = this
				var route = "/start/ventas_mes/report/" + this.date

				axios.get(route).then(
					function (res) {
						console.log(res)
						if (! res.error) {
							self.ventas = res.data.ventas
						} else {
							alert(res.data.message)
						}
					})
			}
		},
		created() {
			this.date = moment().format('YYYY-MM-DD')
			this.get_cash_report()
			this.getVentasMes()
		}

	})
</script>