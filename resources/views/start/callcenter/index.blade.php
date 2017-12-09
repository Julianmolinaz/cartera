@section('title','callcenter')

@section('contenido')
<!--
** VISTA ENCARGADA DE MOSTRAR EL LISTADO DE LOS CLIENTES JUNTO A UNA BARRA DE BUSQUEDA Y LA
** OPCION DE ORDENAMIENTO
**
-->

@section('title','Creditos')
@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-warning">
    <div class="panel-heading"><h2>CallCenter&nbsp;&nbsp;&nbsp;&nbsp;{{$busqueda->busqueda}}


        <div class="pull-right">
          <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-warning" onclick="Busqueda('Agenda');" data-toggle="tooltip" data-placement="top" title="Muestra los agendados del día anterior">Agendados</button>
            <button type="button" class="btn btn-primary" onclick="Busqueda('Morosos');">Todos los Morosos</button>
            <button type="button" class="btn btn-danger"  onclick="Busqueda('Todos');">Todos los Créditos</button>
            <button type="button" class="btn btn-default" onclick="Exportar();">Exportar xls</button>
          </div>
         </div>

     </h2>
    </div>
    <div class="panel-body">
        <p>
         @include('flash::message')
        </p>

        <div id="msj-success" class="alert alert-success alert-dismissible" role="alert" style="display:none">
          <strong> Llamada Registrada Correctamente.</strong>
        </div>
        

        <div style="display:none;">{{$fila = 1}}</div>


        <table id="datatable" data-order='[[ 0, "asc" ]]' class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr>
              <th>    #             </th>
              <th>    Cartera       </th>
              <th>    Credito id    </th>
              <th>    Ciudad cliente</th>
              <th>    Estado        </th>
              <th>    Dias en mora  </th>
              <th>    Cliente       </th>
              <th>    Documento     </th>
              <th>    Pago hasta    </th>
              <th>    Agenda        </th>
              <th>    Call          </th>
              <th>    Llamó         </th>
              <th>    Acción        </th>
            </tr>
          </thead>


          <tbody>

          <!-- cuando se traen listado de creditos -->

          @if(isset($creditos))

            @foreach($creditos as $credito)
              <tr>
                <td>{{  $fila++                               }}</td>
                <td>{{  $credito->precredito->cartera->nombre }}</td>
                <td>{{  $credito->id                          }}</td>
                <td>*{{  $credito->precredito->cliente->municipio->nombre.'-'.
                        $credito->precredito->cliente->municipio->departamento
                }}</td>

                <td>
                  @if($credito->estado == 'Al dia')

                    <spam class="label label-primary">={{$credito->estado}}</spam>

                  @elseif($credito->estado == 'Mora')
                  
                    <spam class="label label-danger">={{$credito->estado}}<spam>  

                  @elseif($credito->estado == 'Prejuridico')

                    <spam class="label label-success">={{$credito->estado}}</spam>

                  @elseif($credito->estado == 'Juridico')

                    <spam class="label label-info">={{$credito->estado}}</spam>

                  @else
                    <spam class="label label-warning">={{$credito->estado}}</spam>
                  @endif

                </td>
                <?php
                  if(count($credito->sanciones) >= 1 ){
                    $sanciones = 0;
                    foreach($credito->sanciones as $sancion){
                      if($sancion->estado == 'Debe'){
                        $sanciones++;
                      }
                    }
                    echo "<td>".$sanciones."</td>"; 
                  }   
                  else{
                    echo "<td>0</td>";
                  }        
                ?>
                <td>{{  $credito->precredito->cliente->nombre }}</td>
                <td>{{  $credito->precredito->cliente->num_doc}}</td>
                <td>{{  $credito->fecha_pago->fecha_pago      }}</td>

              @if($credito->llamadas->last())
                <td>{{  $credito->llamadas->last()->agenda}}</td>
                <td>{{  '['.$credito->llamadas->last()->created_at.'] '.$credito->llamadas->last()->observaciones}}</td>
                <td>{{  $credito->llamadas->last()->user_create->name}}</td>

              @else
                <td></td>
                <td></td>
                <td></td>
              @endif
                <td>
                  <a href="#"  id="btn_registro" OnClick='Mostrar({{$credito->id}});' class = 'btn btn-default btn-xs' data-toggle="modal" data-target="#myModal">
                    <span class = "glyphicon glyphicon-phone-alt" data-toggle="tooltip" data-placement="top" title="Registro de llamada"></span>
                  </a>

                  <a href="{{route('call.show',$credito->id)}}"  class = 'btn btn-default btn-xs'>
                    <span class = "glyphicon glyphicon-tasks" data-toggle="tooltip" data-placement="top" title="Información del crédito"></span>
                  </a>

                </td>
              </tr>
            @endforeach

          <!-- cuando se trae solo un credito, funcionalidad del buscador -->
          @else

              <tr>
                <td>{{  $fila++                               }}</td>
                <td>{{  $credito->precredito->cartera->nombre }}</td>
                <td>{{  $credito->id                          }}</td>
                <td>*{{  $credito->precredito->cliente->municipio->nombre.'-'.
                        $credito->precredito->cliente->municipio->departamento
                }}</td>

                <td>
                  @if($credito->estado == 'Al dia')

                    <spam class="label label-primary">{{$credito->estado}}</spam>

                  @elseif($credito->estado == 'Mora')
                  
                    <spam class="label label-danger">{{$credito->estado}}<spam>  

                  @elseif($credito->estado == 'Prejuridico')

                    <spam class="label label-success">{{$credito->estado}}</spam>

                  @elseif($credito->estado == 'Juridico')

                    <spam class="label label-info">{{$credito->estado}}</spam>

                  @else
                    <spam class="label label-warning">{{$credito->estado}}</spam>
                  @endif

                </td>
                <?php
                  if(count($credito->sanciones) >= 1 ){
                    $sanciones = 0;
                    foreach($credito->sanciones as $sancion){
                      if($sancion->estado == 'Debe'){
                        $sanciones++;
                      }
                    }
                    echo "<td>".$sanciones."</td>"; 
                  }   
                  else{
                    echo "<td>0</td>";
                  }        
                ?>
                <td>{{  $credito->precredito->cliente->nombre }}</td>
                <td>{{  $credito->precredito->cliente->num_doc}}</td>
                <td>{{  $credito->fecha_pago->fecha_pago      }}</td>

              @if($credito->llamadas->last())
                <td>{{  $credito->llamadas->last()->agenda}}</td>
                <td>{{  '['.$credito->llamadas->last()->created_at.'] '.$credito->llamadas->last()->observaciones}}</td>
                <td>{{  $credito->llamadas->last()->user_create->name}}</td>

              @else
                <td></td>
                <td></td>
                <td></td>
              @endif
                <td>
                  <a href="#"  id="btn_registro" OnClick='Mostrar({{$credito->id}});' class = 'btn btn-default btn-xs' data-toggle="modal" data-target="#myModal">
                    <span class = "glyphicon glyphicon-phone-alt" data-toggle="tooltip" data-placement="top" title="Registro de llamada"></span>
                  </a>

                  <a href="{{route('call.show',$credito->id)}}"  class = 'btn btn-default btn-xs'>
                    <span class = "glyphicon glyphicon-tasks" data-toggle="tooltip" data-placement="top" title="Información del crédito"></span>
                  </a>

                </td>
              </tr>




          @endif
          </tbody>
        </table>

      </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Call Center</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">

            <form>

              <input type="hidden" name="_token"  value="{{csrf_token()}}" id="token">
              <input type="hidden" id="id">

              <!--****************************************-->
              <div class="panel panel-default">
                  <div class="panel-heading">Información del Cliente</div>
                  <div class="panel-body">

                    <div class="form-group">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <label>Cliente</label>
                        <input type="text" class="form-control input-sm" id="nombre" style="border: none;" value="" readonly>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                         <label>Documento</label>
                         <input type="text" class="form-control input-sm" id="documento" style="border: none;" readonly>
                      </div>
                    </div>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <label>Movil</label>
                         <input type="text" class="form-control input-sm" id="movil" style="border: none;" readonly>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <label>Fijo</label>
                         <input type="text" class="form-control input-sm" id="fijo" style="border: none;" readonly>
                      </div>

                    </div>
                  </div>
                </div>

              <div class="panel panel-default">
                  <div class="panel-heading">Notificación al Cliente</div>
                  <div class="panel-body">

                    <div class="form-group">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <label>Motivo de la llamada *:</label>
                        <select class="form-control input-sm" name="criterio" id="criterio">
                          <option value="" disabled selected hidden="">- -</option>
                          @foreach($criterios as $criterio)
                            <option value="{{$criterio->id}}" id="criterio_id">{{$criterio->criterio}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label for="">Agenda :</label>
                        <input type="text" class="form-control" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="agenda" name="agenda">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                         <label>Observaciones</label>
                         <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder='Escriba acá las observaciones'></textarea>
                      </div>
                    </div>

                  </div>
              </div>
              <!--****************************************-->

             <center>
                <a href="#"  class = 'btn btn-danger' id="salir" OnClick='Salir();'>Salir</a>
                <a href="#"  class = 'btn btn-default' id="info" OnClick='Info();' data-toggle="tooltip" data-placement="top" title="Información del crédito">Info</a>
                <a href="#"  class = 'btn btn-primary' id="aceptar" OnClick='Aceptar();'>Aceptar</a>
             </center>

            </form>

          </div>
        </div>
      </div>



    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->




<script>


  $( document ).ready(function() {

    $('#datatable').dataTable( {

      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  
      'scrollY': 400,
      "scrollCollapse": true

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



</script>



@endsection
@include('templates.main2')
