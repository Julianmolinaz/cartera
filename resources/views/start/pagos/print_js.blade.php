<script>
	var print = function(factura_id){
		var route = "{{ url('start/invoice-print') }}/" + factura_id;
		$.get(route, function(res){
			print_fact(res);
		})
	}

	var printFactPrecredito = function(factura_id){
		var route = "{{ url('start/precredito-invoice-print') }}/" + factura_id;
		$.get(route, function(res){
			print_fact(res);
		})
	}

	var print_fact = function(str){
		var printed = window.open('','Print-Window');
		printed.document.write(str);
		printed.document.close();
		printed.print();
        setTimeout(() => {
            printed.close();
        }, 1000);
	}

	//muestra detalle de factura

	var show_fact = function(factura_id){
		  window.open("{{url('start/facturas')}}/"+factura_id, '_blank');
	}
</script>
