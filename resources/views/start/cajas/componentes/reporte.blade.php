<script>
	Vue.component('reporte-component',{
		template:`
			<div>
				 <ul class="list-group">

			      <li class="list-group-item">

			        <div class="form-group has-info has-feedback">
			          <label class="control-label" for="inputSuccess2">Fecha de reporte</label>
			          <input type="date" class="form-control" v-model="date">
			          <span class="glyphicon glyphicon-calendar form-control-feedback" aria-hidden="true"></span>
			        </div>
			      </li>
			    </ul>
			 
			    
			    <ul class="list-group">

			      <li class="list-group-item">
			        <center>
			          <h4>Reporte Caja</h4>
			        </center>
			      </li>

			      <li class="list-group-item">
			        <span class="badge">14</span>
			        <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			        Llamadas
			      </li>
			      <li class="list-group-item">
			          <span class="badge">14</span>
			          <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			          Valor negocios
			        </li>
			      <li class="list-group-item">
			        <span class="badge">14</span>
			        <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
			        Solicitudes
			      </li>
			    </ul>
			    @{{$data}}
			</div>
		`,
		data(){
			return {
				date:''
			}
		},
		methods: {
			get_cash_report:function() {
				var self = this
				var route = "/start/cajas/report/" + this.date

				axios.get(route).then(
					function (res) {
						console.log(res)
					})
			}
		},
		created() {
			this.date = moment().format('YYYY-MM-DD')
			this.get_cash_report()
		}

	})
</script>