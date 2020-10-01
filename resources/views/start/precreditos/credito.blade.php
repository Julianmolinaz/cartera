@if($precredito->credito)   

  	@if($precredito->credito->refinanciacion == 'No')
  	<div class="panel panel-primary">
		@else
		<div class="panel panel-info">
			@endif  
			<div class="panel-heading" style="font-weight: bold;font-size: 150%;">Crédito{{' # '.$precredito->credito->id}}
				
				<!-- Para los créditos no cancelados se muestran las siguintes opciones  -->

				@if($precredito->credito->estado == 'Al dia'  ||
					$precredito->credito->estado == 'Mora'    ||
					$precredito->credito->estado == 'Prejuridico' ||
					$precredito->credito->estado == 'Juridico') 

					<!-- HACER PAGO -->
						
					<a 	href="{{route('start.facturas.create',$precredito->credito->id)}}" 
						class='btn btn-default btn-xs'
						data-toggle="tooltip" 
						data-placement="top" 
						title="Hacer Pago">
						<span class = "glyphicon glyphicon-usd"></span>
					</a>
					<a href="{{route('start.clientes.show',$precredito->cliente->id)}}" 
						class = 'btn btn-default btn-xs' 
						data-toggle="tooltip" 
						data-placement="top" 
						title="Ver Cliente">
						<span class = "glyphicon glyphicon-user" ></span>
					</a>
					<a href="{{route('admin.sanciones.show',$precredito->credito->id)}}" 
						class = 'btn btn-default btn-xs' 
						data-toggle="tooltip" 
						data-placement="top" 
						title="Sanciones diarias">
						<span class = "glyphicon glyphicon-record" ></span>
					</a>
					<a  href="{{route('admin.multas.show',[$precredito->credito->id])}}" 
						class = 'btn btn-default btn-xs' 
						data-toggle="tooltip" 
						data-placement="top" 
						title="Multas prejuridicas y juridicas">
						<span class="glyphicon glyphicon-hourglass"></span>
					</a>

				@endif  

				<!-- Botones que todos pueden visualizar  -->

				<a href="{{route('call.index_unique',$precredito->credito->id)}}"
					class = 'btn btn-default btn-xs'
					data-toggle="tooltip" 
					data-placement="top" 
					title="Llamar">
					<span class = "glyphicon glyphicon-phone-alt"></span>
				</a>
				<a href="javascript:void(0);"
					onclick="getPazYsalvo()"
					class = 'btn btn-default btn-xs'  
					data-toggle="tooltip" 
					data-placement="top" 
					title="Paz y Salvo">
					<span class = "glyphicon glyphicon-file">
				</a>
				<a href="{{route('admin.get_estado_cuenta',$precredito->credito->id)}}"
					class = 'btn btn-default btn-xs'
					data-toggle="tooltip" 
					data-placement="top" 
					title="Estado de cuenta">
					<span><i class="fab fa-laravel"></i></span>
				</a>
				<a href="{{route('start.creditos.destroy',$precredito->credito->id)}}"
					class="btn btn-default btn-xs"
					onclick="return confirm('¿Esta seguro de eliminar el crédito?')" 
					data-toggle="tooltip"
					data-placement="top"
					title="Eliminar Crédito">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</div>
		
			@include('flash::message')

			<table class="table" style="font-size:12px">
				<tr>  
					<th scope="row">Estado </th>
					<td> {{$precredito->credito->estado}}</td>
				</tr>
				@if($precredito->credito->mes)
				<tr>  
					<th scope="row">Mes de referencia </th>
					<td> <span class="label label-primary">{{$precredito->credito->mes}}</span></td>
				</tr> 
				@endif       
				<tr>  
					<th scope="row">Fecha de aprobacion </th>
					<td> {{$precredito->credito->created_at}}</td>
				</tr>
				<tr>  
					<th scope="row">Fecha límite de pago </th>
					<td style="color:red;"> {{ $precredito->credito->fecha_pago->fecha_pago}}</td>
				</tr>        
				<tr>  
					<th scope="row">Valor Total Crédito </th>
					<td> {{'$ '.number_format($precredito->credito->valor_credito,0,",",".")}}</td>
				</tr>
				<tr class="danger">  
					<th scope="row">Saldo Deuda </th>
					<td> <span class="label label-danger" style="font-size:1em">{{'$ '.number_format($precredito->credito->saldo,0,",",".")}}</span></td>
				</tr>  
				<tr>  
					<th scope="row">Rendimiento </th>
					<td> {{'$ '.number_format($precredito->credito->rendimiento,0,",",".")}}</td>
				</tr>
				<tr>
					<th scope="row">Cuotas Faltantes</th>
					<td> {{$precredito->credito->cuotas_faltantes.' de '.$precredito->cuotas}}</td>
				</tr>
				<tr>
					<th scope="row">Refinanciación</th>
					<td> {{ $precredito->credito->refinanciacion }} </td>
				</tr>
				<tr>
					<th scope="row">Crédito padre</th>

				@if($precredito->credito->refinanciacion == 'Si')
					<td> 
						<a href="{{route('start.precreditos.ver',$precredito->credito->refinanciado->precredito->id)}}" 
							class="btn btn-info btn-xs">
							{{ $precredito->credito->credito_refinanciado_id }} 
						</a>  
					</td>  
				@else
					<td> </td>
				@endif  
				</tr>
				<tr>
					<th scope="row">Crédito hijo</th>
						@if($hijo)
						<td> 
						<a href="{{route('start.precreditos.ver',$hijo->precredito_id)}}" 
							class="btn btn-info btn-xs">
							{{ $hijo->id }} 
						</a>  
					</td>  
					@else
						<td> </td>
					@endif  
				</tr>
				<tr class="danger">  
					<th scope="row">Saldo a Favor </th>
					<td> {{'$ '.number_format($precredito->credito->saldo_favor,0,",",".")}}</td>
				</tr>
				<tr class="danger">  
					<th scope="row">Juridico </th>
					<td> {{'$ '.number_format($juridico['juridico'],0,",",".").' de '.number_format($juridico['valor'],0,",",".")}}
						@permission('ver_seguimiento_proceso_prejuridico')  
						<a href="{{ route('admin.anotaciones.index', $precredito->credito->id) }}" title="Haga seguimiento legal"
							class="btn btn-primary btn-xs pull-right" style="margin-right: 23px;">
							Proceso jurídico &nbsp;<i class="fas fa-gavel"></i></a>
						@endpermission      
					</td>
				</tr>
				<tr class="danger">  
					<th scope="row">Prejuridico </th>
					<td> {{'$ '.number_format((int)$prejuridico['prejuridico'],0,",",".").' de '.$prejuridico['valor']}}</td>
				</tr>  
				<tr class="danger">  
					<th scope="row">Sanciones diarias</th>
					<td style="position:relative;"> {{'$ '.number_format($sanciones,0,",",".")}}
							<select class="form-control input-sm" style="width:40%; position:absolute; top:1px; left:50%;">
								<?php
								
								$debe = 0;
								$exoneradas = 0;
								$pagadas = 0;
								
								foreach($precredito->credito->sanciones as $sancion){
									if($sancion->estado == 'Debe'){  $debe++;}
									else if($sancion->estado == 'Exonerada'){  $exoneradas++; }
									else if($sancion->estado == 'Ok'){  $pagadas++; }
								}
								echo  "<option> Debe: ".$debe."</option>".
										"<option> Pagadas: ".$pagadas."</option>".
										"<option>Exoneradas: ".$exoneradas."</option>";
							?>
							</select>
					</td>
				</tr>                
				<tr class="danger">  
					<th scope="row">Debe de pagos parciales</th>
					<td> {{'$ '.number_format($parciales,0,",",".")}}</td>
				</tr> 
				<tr>
					<th scope="row">Total pagos:</th>
					<td>{{'$ '.number_format($total_pagos,0,",",".")}}</td>
				</tr>
				<tr>  
					<th scope="row">Castigada </th>
					<td> {{$precredito->credito->castigada}}</td>
				</tr>     
				<tr>  
					<th scope="row" title="Funcionario que ingreso al sistema">Creó.</th>
					<td> <small>{{$precredito->credito->user_create->name.' '.$precredito->credito->created_at}}</small></td>
				</tr>                   
				<tr>  
					<th scope="row">Actualizó </th>
					<td> <small>{{$precredito->credito->user_update->name.' '.$precredito->credito->updated_at}}</small></td>
				</tr>  
			</table>
		</div>
  	</div>

@endif
