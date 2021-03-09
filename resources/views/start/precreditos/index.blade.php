@section('title','Solicitudes')
@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-warning">
    <div class="panel-heading">
      <h2>Solicitudes <i class="fas fa-file-alt"></i>


        <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">
        &nbsp;&nbsp;Exportar&nbsp;&nbsp;
        </button>
      </h2>
    </div>
    <div class="panel-body" id="solicitudes">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>

       <div style="display:none;">{{$fila = 1}}</div>

       <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered pagos-pre" style="font-size:12px">
        <thead>
          <tr  style="background-color:#FFC300;">
          <th style="display:none;">    Actualizacion  </th>
          <th> # </th>
            <th>    Solicitud id  </th>
            <th>    Factura       </th>
            <th>    Cartera       </th>
            <th>    Fecha aprobación       </th>
            <th>    Cliente       </th>
            <th>    Doc           </th>
            <th>    Aprobado?     </th>
            <th>    Observaciones </th>
            <th>    Creó          </th>
            <th>    Acción        </th>
          </tr>
        </thead>
          <tbody>

            @foreach($precreditos as $precredito)
            <tr>
          <td style="display:none;"> {{$precredito->updated_at}}</td>
          <td>{{$fila++}}</td>
              <td> {{$precredito->id}}          </td>
              <td> {{$precredito->num_fact}}    </td>
              <td> {{$precredito->cartera->nombre}}</td>
              <td> {{$precredito->fecha}}       </td>
              <td> {{$precredito->cliente->nombre}}</td>
              <td align="right"> {{$precredito->cliente->num_doc}}</td>
              <td> {{$precredito->aprobado}}    </td>
              <td> <small>{{$precredito->observaciones}}</small></td>
              <td> <small>{{$precredito->user_create->name.' ('.$precredito->created_at.')  '}}</small></td>


              <td>
                <a href="{{route('start.precreditos.ver',$precredito->id)}}" class = 'btn btn-default btn-xs'>
                  <span class = "glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Ver solicitud"></span>
                </a>
                <a href="{{route('start.clientes.show',$precredito->cliente_id)}}" class = 'btn btn-default btn-xs'>
                  <span class = "glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Ver cliente"></span>
                </a>
                <a href="{{route('start.fact_precreditos.create',$precredito->id)}}" class = 'btn btn-default btn-xs'>
                  <span class = "glyphicon glyphicon-lamp" data-toggle="tooltip" data-placement="top" title="Iniciales y estudios"></span>
                </a>
                @if($precredito->credito)
                  <a href="{{route('start.precreditos.ver',$precredito->id)}}" class = 'btn btn-default btn-xs'>
                    <span class = "glyphicon glyphicon-sunglasses"  data-toggle="tooltip" data-placement="top" title="Ver Crédito"></span>
                  </a>
                @endif

                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  

  <div style="margin-left:30px;">
    {{ $precreditos->links() }}
  </div>

  <script>
    $( document ).ready(function() {
      $('#datatable').dataTable( {
        'scrollY'       : 500,
        'paging'        : false,
        "scrollCollapse": true,
        "iDisplayLength": 500

      });
    });

    function Exportar(){
      $('#datatable').table2excel({
        name: 'solicitudes',
        filename: "solicitudes.xls"
      });
    }



  </script>


  @endsection
  @include('templates.main2')
