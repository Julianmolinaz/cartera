
<div id="element" class="table-responsive">
 	<table class="table table-striped table-bordered" style="font-size:12px; width:100%">
		<thead>
			<tr>  
				<th>    Id Pago    </th>   
				<th>    Id Recibo </th>
				<th>    # Recibo  </th>
				<th>    Fecha      </th>
				<th>    Concepto   </th>
				<th>    Subtotal   </th>
				<th>    Acción     </th>
			</tr>
		</thead>
		<tbody>
			@foreach($pagos as $pago)
				<tr>
					<td>{{ $pago->id 				}}</td>
					<td>{{ $pago->factura->id       }}</td>
					<td>{{ $pago->factura->num_fact }}</td>
					<td>{{ $pago->factura->fecha    }}</td>
					<td>{{ $pago->concepto->nombre  }}</td>
					<td>{{ $pago->subtotal          }}</tds>
					<td>
					<a href="{{ route('start.precred_pagos.show', $pago->factura->id) }}"
                    class="btn btn-default btn-xs">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
		                <a href="#" class='btn btn-default btn-xs' @click="print('{{$pago->factura->id}}')">
		                	<span class = "glyphicon glyphicon-print" title="Imprimir"></span>
		                </a>  
		              </td>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<script>

  const element = new Vue({
    el:  '#element',
    methods: {
      print(factura_id){
      	var self = this
        var route = "{{ url('start/precredito-invoice-print') }}/" + factura_id
        axios.get(route).then(function(res){
        	self.print_html(res.data)
        })
      },//.print
      print_html(str){
				var printed = window.open('','Print-Window');
				printed.document.write(str);
				printed.document.close();
				printed.print();
                setTimeout(() => {
                    printed.close();
                }, 1000);
		}//.print_html
				}
    });
</script>
