<script>

$( document ).ready(function() {


  //alert('ready!!');
  var bandera = 0;
  var bandera2  = 0;
  $('#monto').val("");


/***************** AGREGAR *******************************/


  //agrega los pagos a una tabla "tabla". Ojo no se puden agregar dos pagos con el mismo concepto

  $('#agregar').on('click',function(e){

    bandera2 = 1;

    if (bandera == 1) { return true; }

    var concepto    = $('#concepto').val();
    var monto       = $('#monto').val();
    var credito_id  = {{$credito->id}};
    var token       = $('#token').val();
    var route       = "{{url('start/facturas/abonos')}}";

    $.ajax({
      url     : route,
      headers : {'X-CSRF-TOKEN': token},
      type    : 'POST',
      dataType: 'json',

      data:{  concepto: concepto , monto:monto , credito_id:credito_id },
      success: function( data ) {
        $("#tabla tr:last").before(data['fila']);
        var totalDeuda=0;
        $(".vlr").each(function(){ totalDeuda+=parseInt($(this).html()) || 0;  });
        $('#total').text(totalDeuda);
      }
    });
      bandera = 1;

    });

   $('#borrar').on('click',function(){
      $('#tabla tbody tr').each(function(){
        $(".otras_filas").remove();
      });
      $('#total').text(0);
      bandera = 0;
      bandera2 = 0;
    });


// El boton aceptar valida cierta información y la envía al controlador FacturaController funcion store para ser procesada

 $('#aceptar').on('click',function(){


  if(bandera2 == 0){ return false;}

  var validacion = validar();

  if (validacion == true){ //valida los campos # Factura y Fecha del Genrador de pagos con true si tienen la información

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

          $('#datos').val(myTableArray.join(", "));

          var r = confirm('Esta seguro de realizar la transacción?????');

          if(!r){ return false; }

          // var num_factura   = $('#num_factura').val();
          var fecha_factura = $('#fecha_factura').val();
          var tipo_pago     = $('select[id = tipo]').val();
          var pagos         = $('#datos').val() ;
          var sum_sanciones = "{{$sum_sanciones}}";
          var credito_id    = "{{$credito->id}}"
          var token         = $('#token').val();
          var route         = "{{url('start/facturas')}}";

          $.ajax({
            url : route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            dataType: 'json',
            data:{info:pagos,credito_id:credito_id, num_factura:num_factura, fecha_factura:fecha_factura,
                  sum_sanciones:sum_sanciones, tipo_pago:tipo_pago},
            success: function( msg ) {
              alert(msg.mensaje);
              document.location.href="{{route('start.facturas.create',$credito->id)}}";
            }
          });
        }
        else{ alert('El número de Factura ya existe !!!'); }
      });
    }

  });

});//end document.ready


// evento que se activa al pulsar el concepto de un pago ingresado en la table "tabla"

function Eliminar(i){
  document.getElementById('tabla').deleteRow(i);
  var totalDeuda=0;
  $(".vlr").each(function(){ totalDeuda+=parseInt($(this).html()) || 0;  });
  $('#total').text(totalDeuda);
}

function validar(){
  var mensaje = "";
  if($('#num_factura').val() == ''){
    mensaje = " # Factura, ";
  }
  if($('#fecha_factura').val() == ''){
    mensaje = mensaje+" Fecha, ";
  }
  if($('select[id = tipo]').val() == ''){
    mensaje = mensaje+" Tipo de Pago, ";
  }
  if(mensaje != ""){
    alert("Se requiere "+mensaje);
    return false;
  }
  else{
    return true;
  }
}



</script>
