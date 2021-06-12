<script>
	Vue.component('reporte-component',{
		template:`
			<div>
				 <ul class="list-group">

			     <li class="list-group-item">

			        <div class="form-group has-info has-feedback"  style="margin-bottom:0px;">
			                               <center>
                            <label class="control-label" for="inputSuccess2">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            @{{ (info.punto) ? info.punto.nombre : '' }}@{{' '+info.date}}</label>
                            <br>
                        
                            <img src="/iconosFree/snail.svg"  width="80" v-if="ventas == 0">
                            <img src="/iconosFree/turtle.svg" width="80" v-else-if="ventas > 0 && ventas <= 4000000">
                            <img src="/iconosFree/pig.svg"  width="80" v-else-if="ventas > 4000000 && ventas <= 8000000">
                            <img src="/iconosFree/seal.svg"  width="80" v-else-if="ventas > 8000000 && ventas <= 12000000">
                            <img src="/iconosFree/ladybug.svg" width="80" v-else-if="ventas > 12000000 && ventas <= 16000000">
                            <img src="/iconosFree/penguin.svg" width="80" v-else-if="ventas > 16000000 && ventas <= 18000000">
                            <img src="/iconosFree/elephant.svg" width="80" v-else-if="ventas > 18000000 && ventas <= 20000000">
                            <img src="/iconosFree/bat.svg" width="80" v-else-if="ventas > 20000000 && ventas <= 24000000">
                            <img src="/iconosFree/fox.svg" width="80" v-else-if="ventas > 24000000 && ventas <= 28000000">
                            <img src="/iconosFree/oul.svg" width="80" v-else-if="ventas > 28000000 && ventas < 30000000">
                            <img src="/iconosFree/whale.svg" width="80" v-else>
                            <br>
                            <label>Ventas mes: @{{ventas}}</label>
                            <br>
                        </center>
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
			          <span class="badge">@{{ info.total_otros_pagos }}</span>
			          <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			          Otros Pagos
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
