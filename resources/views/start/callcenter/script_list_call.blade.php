<script>


  $( document ).ready(function() {

    $('#datatable').dataTable( {

      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  
      'scrollY': 400,
      "scrollCollapse": true,
      'paging': false,
      "iDisplayLength": 500

    });

  });

var credito_id;
var count_click = 0; // INCREMENTABLE QUE PERMITE NO ENVIAR DOS VECES UNA MISMA LLAMADA

function Salir(){
    $("#myModal").modal('toggle');
  }

function Mostrar(id){
  var route  = "{{url('call')}}/"+id+"/consultar";
  credito_id = id;
  $.get(route,function(res){
    $('#id').val(res.credito.id);
    $('#nombre').val(res.credito.precredito.cliente.nombre);
    $('#documento').val(res.credito.precredito.cliente.num_doc);
    $('#movil').val(res.credito.precredito.cliente.movil);
    $('#fijo').val(res.credito.precredito.cliente.fijo);
  });

}

function Aceptar()
{

  //VALIDACIÓN DE CAMPO CRITERIO Y OBSERVACIONES REQUERIDOS

  if(($('#criterio').val() === null) || ($('#observaciones').val() === ''))
  {
    alert('Los campos con asterisco (*) son obligatorios');
    return false;
  }

  if($('#agenda').val() == ""){
    var agenda      = null;
  }
  else{
    var agenda      = $('#agenda').val();
  }
  var efectiva      = $('input:radio[name=efectiva]:checked').val();
  var criterio_id   = $('#criterio').val();
  var observaciones = $('#observaciones').val();

  var route         = "{{url('call/call_create')}}";
  var token         = $("#token").val();

  if(count_click == 0){
    count_click++;
    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: 'POST',
      dataType: 'json',
      data: {
        efectiva  : efectiva,
        credito_id: credito_id, 
        criterio_id: criterio_id, 
        observaciones: observaciones, 
        agenda:agenda 
        },
      success: function(){
        $("#myModal").modal('toggle');
        $("#msj-success").fadeIn();
        location.reload();
      }
    });
  }
  else{
    alert('Se esta procesando el envio de la llamada');
  }

}

function Info(){
  var id = $("#id").val();
  window.open("{{url('call')}}/"+id, '_blank');

}

function infoDesdeListado(id){
  window.open("{{url('call')}}/"+id, '_blank');
}

function Busqueda(opcion){
  var route = "{{url('call')}}/"+opcion+"/busqueda";
    $.get(route,function(data){
      if(data){ location.reload(); }
      else{  alert('Ocurrió un error, intentelo de nuevo.'); }
    });
}

function Exportar(){
  $('#datatable').table2excel({
    name: 'CallCenter',
    filename: "callcenter.xls"
  });
}

function ExportarTodo(){
  window.open("{{url('call/exportar/todo/true')}}", '_blank');
}
function ExportarTodoPunto(){
  window.open("{{url('call/exportar/todo')}}", '_blank');
}

function soat(){
  window.open("{{url('call/exportar/soat')}}", '_blank');
}


</script>