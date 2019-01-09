<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contrato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>

	<div class="row">
	  <div class="col-md-1 col-sm-1"></div>

	  <!--Panel Precredito-->
	  <div class="col-md-10 col-sm-10 col-xs-12">

	    <div class="panel panel-default">
	      <div class="panel-heading">Factura</div>

	      <div class="panel-body">

	       <table class="table table-bordered">
	        <thead>
	          <tr>
	            <th>    #         </th>
	            <th>    Cliente   </th>
	            <th>    Crédito id</th>
	            <th>    # Factura </th>
	            <th>    Fecha     </th>
	            <th>    Total     </th>
	            <th>    Creó      </th>
	            <th style="display:none;">    Actualizacion  </th>


	          </tr>
	        </thead>

	        <tbody>
	          <tr>
	            <td> {{ $factura->id }}    </td>
	            <td> {{ ($factura->credito) ? $factura->credito->precredito->cliente->nombre : ''}} </td>
	            <td> {{ ($factura->credito) ? $factura->credito_id : ''}} </td>
	            <td> {{ $factura->num_fact }}</td>
	            <td> {{ $factura->fecha }}</t d>
	            <td> {{ number_format($factura->total,0,",",".") }}</td>
	            <td> {{ $factura->user_create->name.' '.$factura->created_at }} </td>
	            <td style="display:none;"> {{$factura->updated_at}}</td>
	          </tr>

	        </tbody>
	      </table>

	    </div>
	  </div>
	</div>
	<div class="col-md-1 col-sm-1"></div>
	</div>


	<div class="row">
	  <div class="col-md-1 col-sm-1"></div>

	  <!--Panel Precredito-->
	  <div class="col-md-10 col-sm-10 col-xs-12">

	    <div class="panel panel-default">

	      <div class="panel-body">

	          @if(isset($factura->pagos[0]))

	            <table class="table table-bordered">
	              <thead>
	                <tr>
	                  <th>   id         </th>
	                  <th>   Crédito    </th>
	                  <th>   Concepto   </th>
	                  <th>   Abono      </th>
	                  <th>   Debe       </th>
	                  <th>   Estado     </th>
	                  <th>   Pago desde </th>
	                  <th>   Pago hasta </th>
	                  <th>   Actividad  </th>
	                </tr>
	              </thead>

	              <tbody>

	              @foreach( $factura->pagos as $pago)
	              <tr>
	                <td> {{ $pago->id}}</td>
	                <td> {{ $factura->credito_id}} </td>
	                <td> {{ $pago->concepto }}     </td>
	                <td align="right"> {{ number_format($pago->abono,0,",",".") }}  </td>
	                <td align="right"> {{ number_format($pago->debe,0,",",".")  }}  </td>
	                <td> {{ $pago->estado}}        </td>
	                <td> {{ $pago->pago_desde}}    </td>
	                <td> {{ $pago->pago_hasta}}    </td>
	                <td></td>
	              </tr>
	              @endforeach

	            @elseif(isset($factura->otro_pago[0]))

	              <table class="table table-bordered">
	              <thead>
	                <tr>
	                  <th>   id             </th>
	                  <th>   Cartera        </th>
	                  <th>   Concepto       </th>
	                  <th>   Valor unitario </th>
	                  <th>   Cantidad       </th>
	                  <th>   subtotal       </th>
	                </tr>
	              </thead>

	              <tbody>
	              @foreach( $factura->otro_pago as $pago )
	              <tr>
	                <td> {{ $pago->id }} </td>
	                <td> {{ $pago->cartera->nombre }}</td> 
	                <td> {{ $pago->concepto }}</td>
	                <td> {{ $pago->valor_unitario }}</td>
	                <td> {{ $pago->cantidad }}</td>
	                <td> {{ $pago->subtotal }}</td>
	                
	              </tr>
	              @endforeach
	              @else
	              <table class="table table-bordered">
	              <thead>
	                <tr>
	                  <th>    id        </th>
	                  <th>    Crédito   </th>
	                  <th>    Concepto  </th>
	                  <th>    Abono     </th>
	                  <th>    Debe      </th>
	                  <th>    Estado    </th>
	                  <th>   Pago desde </th>
	                  <th>   Pago hasta </th>
	                </tr>
	              </thead>

	              <tbody>
	              </tbody>

	            @endif

	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>

	  <div class="col-md-1 col-sm-1"></div>

	</div>


</body>
</html>


