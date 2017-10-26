<script>

$( document ).ready(function() {


$('#agregar').on('click',function(){
	var validacion = Validar();
	if(validacion){

	    var route = "{{url('start/pagos/insert_pago')}}";
	    var token = $('#token').val();
		var num_factura = $('#num_factura').val();
		var fecha_factura= $('#fecha_factura').val();
		var tipo		= $('#tipo').val();
		var concepto	= $('#concepto').val();
		var valor		= $('#valor').val();
		var cantidad	= $('#cantidad').val();

		$.ajax({
			url:route,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: {concepto:concepto,valor:valor,cantidad:cantidad},
			success: function(res){

				$("#tabla tr:last").before(res);
				var totalDeuda=0;
		        $(".vlr").each(function(){ totalDeuda+=parseInt($(this).html()) || 0;  });
		        $('#total').text(totalDeuda);
		        //Limpiar();

			},
			error: function(res){
			}
		});
	}
});


$('#aceptar').on('click',function(){

	if($("#tabla tr").length < 3){ alert('Requiere agregar un pago');  return false;}

  var validacion = ValidarDatoFactura();

  if (validacion == true){ //valida los campos # Factura y Fecha del Genrador de pagos con true si tienen la información

    var r = confirm('Esta seguro de realizar la transacción?????');
    if(!r){ return false; }


    var num_factura = $('#num_factura').val();
    var route = "{{url('start/facturas')}}/"+num_factura+"/consultar_factura";

    $.get(route,function(data){ //valida que el numero de factura no se repita

        if(!data){
          //convertir tabla en array para enviar a la funcion store de FacturaController mediante ajax
          var myTableArray = [];

          $("table#tabla tr").each(function() {
              var arrayOfThisRow  = [];
              var tableData       = $(this).find('td');
              if (tableData.length > 0) {
                  tableData.each(function() { arrayOfThisRow.push($(this).text()); });
                  myTableArray.push(arrayOfThisRow);
              }
          });

          var num_factura   = $('#num_factura').val();
          var fecha_factura = $('#fecha_factura').val();
          var tipo_pago     = $('select[id = tipo]').val();
          var cartera       = $('select[id = cartera').val();
          var info          = myTableArray.join(", ");
          var token         = $('#token').val();
          var route         = "{{url('start/pagos')}}";

          $.ajax({
            url : route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data:{num_factura:num_factura, fecha_factura:fecha_factura, tipo_pago:tipo_pago,info:info, cartera:cartera},
            success: function( msg) {
              alert(msg.mensaje);  
              document.location.href="{{route('start.pagos.create')}}";
            }
          });
        }
        else{ alert('El número de Factura ya existe !!!'); }  
      });    
    }
  
  });




function Validar(){
	var num_factura   = $('#num_factura').val();
	var fecha_factura = $('#fecha_factura').val();
	var tipo		      = $('#tipo').val();
	var concepto	    = $('#concepto').val();
	var valor		      = $('#valor').val();
	var cantidad	    = $('#cantidad').val();
  var cartera       = $('#cartera').val();
	var message    	  = 'Se requiere: ';
	var bandera 	    = 0;

	if(num_factura == '')	   { message += '# de Factura, ';	bandera = 1; }
	if(fecha_factura == '')  { message += 'fecha, '; 		bandera = 1; }
	if(tipo == '')			     { message += 'tipo de pago, '; 	bandera = 1; }
	if(concepto == '')		   { message += 'concepto, '; 		bandera = 1; }
	if(valor == '')			     { message += 'valor, '; 		bandera = 1; }
	if(cantidad == '')		   { message += 'cantidad, '; 		bandera = 1; }
  if(cartera == '')        { message += 'Cartera, '; bandera = 1; }

	if(bandera == 0){ return true;  }
	else			{ alert(message); return false; } 
}

function ValidarDatoFactura(){
  var num_factura   = $('#num_factura').val();
  var fecha_factura = $('#fecha_factura').val();
  var tipo          = $('#tipo').val();
  var message       = 'Se requiere: ';
  var bandera       = 0;

  if(num_factura == '')    { message += '# de Factura, '; bandera = 1; }
  if(fecha_factura == '')  { message += 'fecha, ';    bandera = 1; }
  if(tipo == '')           { message += 'tipo de pago, ';   bandera = 1; }

  if(bandera == 0){ return true;  }
  else      { alert(message); return false; } 
}

   $('#borrar').on('click',function(){
      $('#tabla tbody tr').each(function(){ $(".otras_filas").remove();     });
      $('#total').text(0);
    });

   $('#limpiar').on('click',function(){  Limpiar();   });

});

function Eliminar(i){
  document.getElementById('tabla').deleteRow(i);
  var totalDeuda=0;
  $(".vlr").each(function(){ totalDeuda+=parseInt($(this).html()) || 0;  });
  $('#total').text(totalDeuda);
}

function Limpiar(){
	var concepto	= $('#concepto').val('');
	var valor		= $('#valor').val('');
	var cantidad	= $('#cantidad').val('');

}
</script>