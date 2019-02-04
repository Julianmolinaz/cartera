<script>
	Vue.component('detalle-component',{
		template: `
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingOne">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
			          Solicitudes
			        </a>
			      </h4>
			    </div>

				<!--SOLICITUDES-SOLICITUDES-SOLICITUDES-SOLICITUDES-SOLICITUDES-SOLICITUDES--->
				<!--SOLICITUDES-SOLICITUDES-SOLICITUDES-SOLICITUDES-SOLICITUDES-SOLICITUDES--->

			    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			      <div class="panel-body">
			       	<table class="table table-striped">
			       		<thead>

							<tr>
								<th>Id</th>
								<th>Cliente</th>
								<th>Centro de costos</th>
								<th>Documento</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="precredito in dat.precreditos">
								<td>@{{ precredito.id }}</td>
								<td>@{{ precredito.cliente }}</td>
								<td>@{{ precredito.vlr_fin }}</td>
								<td>@{{ precredito.documento }}</td>
							</tr>
			       		</tbody>
					</table>
			      </div>
			    </div>
			  </div>

	
			<!--LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-->
			<!--LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-LLAMADAS-->

			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingTwo">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          Llamadas
			        </a>
			      </h4>
			    </div>
			    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			      <div class="panel-body">
			        
			       	<table class="table table-striped">
			       		<thead>

							<tr>
								<th>Crédito</th>
								<th>Agenda</th>
								<th>Observaciones</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="call in dat.calls">
								<td>@{{ call.credito_id }}</td>
								<td>@{{ call.Agenda }}</td>
								<td>@{{ call.observaciones }}</td>
							</tr>
			       		</tbody>
					</table>


			      </div>
			    </div>
			  </div>

			<!--PAGOS_POR_CREDITOS-PAGOS_POR_CREDITOS-PAGOS_POR_CREDITOS-PAGOS_POR_CREDITOS-->
			<!--PAGOS_POR_CREDITOS-PAGOS_POR_CREDITOS-PAGOS_POR_CREDITOS-PAGOS_POR_CREDITOS-->


			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingThree">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          Pagos por creditos
			        </a>
			      </h4>
			    </div>
			    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			      <div class="panel-body">
			        
			       	<table class="table">
			       		<thead>

							<tr>
								<th>Número de factura</th>
								<th>Concepto</th>
								<th>subtotal</th>
								<th>Crédito</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="abono in dat.abonos">
								<td>@{{ abono.num_fact }}</td>
								<td>@{{ abono.concepto }}</td>
								<td>@{{ abono.subtotal }}</td>
								<td>@{{ abono.credito }}</td>
							</tr>
			       		</tbody>
					</table>

			      </div>
			    </div>
			  </div>

		    <!--PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-->
			<!--PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-->


			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingFour">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
			          Pagos por solicitudes
			        </a>
			      </h4>
			    </div>
			    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
			      <div class="panel-body">
			        
			       	<table class="table">
			       		<thead>

							<tr>
								<th>Solicitud</th>
								<th>Número de factura</th>
								<th>Concepto</th>
								<th>subtotal</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="pago in dat.pagos_solicitudes">
								<td>@{{ pago.precredito_id }}</td>
								<td>@{{ pago.num_fact }}</td>
								<td>@{{ pago.concepto }}</td>
								<td>@{{ pago.subtotal }}</td>
							</tr>
			       		</tbody>
					</table>

			      </div>
			    </div>
			  </div>

			</div>
		`,
		data(){
			return {
				a : '123',
				dat : ''
			}
		},
		created(){
			var self = this
			Bus.$on ('get_dat', function(dat){
				self.dat = dat
			})
		}
	});

</script>
