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

function Aceptar(){


  if($('#agenda').val() == ""){
    var agenda      = null;
  }
  else{
    var agenda      = $('#agenda').val();
  }


  var criterio_id   = $('#criterio').val();
  var observaciones = $('#observaciones').val();
  var route         = "{{url('call/call_create')}}";
  var token         = $("#token").val();


   $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'POST',
    dataType: 'json',
    data: {credito_id: credito_id, criterio_id: criterio_id, observaciones: observaciones, agenda:agenda },
    success: function(){
      $("#myModal").modal('toggle');
      $("#msj-success").fadeIn();
      location.reload();
    }
  });

}

function Info(){
  var id = $("#id").val();
  window.open("{{url('call')}}/"+id, '_blank');

}

function infoDesdeListado(id){
  console.log(id);
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
  window.open("{{url('call/exportar/todo')}}", '_blank');

}


</script>