<script>
	var print = function(factura_id){
		var route = "{{ url('start/invoice-print') }}/" + factura_id;
		$.get(route, function(res){
			console.log(res);
			print_fact(res);
		})
	}

	var print_fact = function(str){
		var printed = window.open('','Print-Window');
		printed.document.write(str);
		printed.document.close();
		printed.print();
		printed.close();
	}
</script>