<script>
	Vue.component('detalle-component',{
		template: `
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingOne">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
							<i class="fas fa-file-alt"></i> Solicitudes
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
										<th>Costo del crédito</th>
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
			        <a  class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" 
								  href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<i class="fas fa-phone"></i> Llamadas
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


				<!--ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-->
			<!--ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-ANULADAS-->

			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingSix">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
							<i class="far fa-frown"></i> Anuladas  
			        </a>
			      </h4>
			    </div>
			    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
			      <div class="panel-body">
			        
			       	<table class="table table-striped">
			       		<thead>

							<tr>
								<th>Obligación</th>
								<th>Id obligación</th>
								<th>Cliente</th>
								<th>Num factura</th>
								<th>Fecha factura</th>
								<th>Anula</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="anulada in dat.anuladas">
								<td>@{{ (anulada.credito_id) ? 'Credito' : 'Solicitud'  }}</td>
								<td>@{{ (anulada.credito_id) ? anulada.credito_id : anulada.precredito_id }}</td>
								<td>@{{ anulada.num_doc }}</td>
								<td>@{{ anulada.num_fact }}</td>
								<td>@{{ anulada.fecha }}</td>
								<td>@{{ anulada.anula }}</td>
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
							<i class="fas fa-shopping-cart"></i> Pagos por creditos
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
								<th>Banco</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="abono in dat.abonos">
								<td>@{{ abono.num_fact }}</td>
								<td>@{{ abono.concepto }}</td>
								<td>@{{ abono.subtotal }}</td>
								<td>@{{ abono.credito  }}</td>
								<td>@{{ abono.banco	   }}</td>
							</tr>
			       		</tbody>
					</table>

			      </div>
			    </div>
			</div>

			<!--DESCUENTOS_POR_CREDITOS-DESCUENTOS_POR_CREDITOS-DESCUENTOS_POR_CREDITOS-DESCUENTOS_POR_CREDITOS-->
			<!--DESCUENTOS_POR_CREDITOS-DESCUENTOS_POR_CREDITOS-DESCUENTOS_POR_CREDITOS-DESCUENTOS_POR_CREDITOS-->


			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingDes">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDes" aria-expanded="false" aria-controls="collapseDes">
							<i class="fas fa-shopping-cart"></i> Descuentos a creditos
			        </a>
			      </h4>
			    </div>
			    <div id="collapseDes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingDes">
			      <div class="panel-body">
			        
			       	<table class="table">
			       		<thead>

							<tr>
								<th>Número de factura</th>
								<th>Concepto</th>
								<th>subtotal</th>
								<th>Crédito</th>
								<th>Banco</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="descuento in dat.descuentos">
								<td>@{{ descuento.num_fact }}</td>
								<td>@{{ descuento.concepto }}</td>
								<td>@{{ descuento.subtotal }}</td>
								<td>@{{ descuento.credito  }}</td>
								<td>@{{ descuento.banco    }}</td>
							</tr>
			       		</tbody>
					</table>

			      </div>
			    </div>
			  </div>

			<!--OTROS_PAGOS-OTROS_PAGOS-OTROS_PAGOS-OTROS_PAGOS-->
			<!--OTROS_PAGOS-OTROS_PAGOS-OTROS_PAGOS-OTROS_PAGOS-->


			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingfive">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
							<i class="fas fa-shopping-cart"></i> Otros Pagos
			        </a>
			      </h4>
			    </div>
			    <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
			      <div class="panel-body">
			        
			       	<table class="table">
			       		<thead>

							<tr>
								<th>Número de factura</th>
								<th>Concepto</th>
								<th>Subtotal</th>
								<th>Cartera</th>
								<th>Tipo</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="otro_ingreso in dat.otros_pagos">
								<td>@{{ otro_ingreso.num_fact }}</td>				
								<td>@{{ otro_ingreso.concepto }}</td>				
								<td>@{{ otro_ingreso.subtotal }}</td>				
								<td>@{{ otro_ingreso.cartera }}</td>				
								<td>@{{ otro_ingreso.tipo }}</td>				
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
							<i class="fas fa-shopping-cart"></i> Pagos por solicitudes
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



		    <!--PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-->
			<!--PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-PAGOS_POR_SOLICITUDES-->


			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingSeven">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
							<i class="glyphicon glyphicon-compressed"></i> Egresos
			        </a>
			      </h4>
			    </div>
			    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
			      <div class="panel-body">
			        
			       	<table class="table">
			       		<thead>

							<tr>
								<th>Comprobante</th>
								<th>Concepto</th>
								<th>Valor</th>
								<th>Tipo de pago</th>
								<th>Banco</th>
								<th>Consignación</th>
								<th>Proveedor</th>
							</tr>
			       		</thead>
			       		<tbody>
							<tr v-for="egreso in dat.egresos">
								<td>@{{ egreso.id }}</td>
								<td>@{{ egreso.concepto }}</td>
								<td>@{{ egreso.valor }}</td>
								<td>@{{ egreso.tipo }}</td>
								<td>@{{ egreso.banco }}</td>
								<td>@{{ egreso.num_consignacion }}</td>
								<td>@{{ egreso.proveedor }}</td>
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
