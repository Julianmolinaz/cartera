@section('title','Facturas')
@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <p>
        <h2>
        Facturas Créditos <i class="fas fa-handshake"></i>
        <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button>
      </h2>
      </p>  
    </div>
    <div class="panel-body">
        <p>
         @include('flash::message')
         @include('templates.error')
       </p>


       <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr>
            <th style="display:none;">    Actualizacion  </th>         
              <th>    Factura id      </th>
              <th>    Crédito id      </th>
              <th>    Factura número  </th>
              <th>    Cartera         </th>
              <th>    Fecha           </th>
              <th>    Total           </th>
              <th>    Tipo de pago    </th>
              <th>    Cliente         </th>
              <th>    Documento       </th>
              <th>    Creó            </th>             
              <th>    Acción          </th>

            </tr>
          </thead>

          <tbody>
          @foreach($facturas as $factura)
          <tr>
              <td style="display:none;"> {{$factura->updated_at}}</td>
          		<td> {{ $factura->id }}           </td>
          		<td> 
                @if($factura->credito)
                <a href="{{route('start.precreditos.ver',$factura->credito->precredito->id)}}">
                  {{ $factura->credito_id}} 
                </a>
                @endif
              </td>
          		<td> {{ $factura->num_fact }}     </td>
              <td> {{ ($factura->credito) ? $factura->credito->precredito->cartera->nombre : ''}}</td>
          		<td> {{ $factura->fecha }}        </td>
              <td align="right"> {{ number_format($factura->total, 0, ",", ".") }}</td>
              <td> {{ $factura->tipo }}         </td>
              <td> {{ ($factura->credito) ? $factura->credito->precredito->cliente->nombre : '' }}           </td>
              <td align="right"> {{ ($factura->credito) ? $factura->credito->precredito->cliente->num_doc : ''}}</td>
              <td> <small>{{$factura->user_create->name.' ['.$factura->created_at.']'}}</small></td>
          		<td> 
              <a href="{{route('start.facturas.show',$factura->id)}}" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Ver Factura">
                <span class = "glyphicon glyphicon-eye-open"  ></span>
              </a>
              @if($factura->credito)
              <a href="{{route('start.precreditos.ver',$factura->credito->precredito->id)}}" class = 'btn btn-default btn-xs'>
                <span class = "glyphicon glyphicon-sunglasses"  data-toggle="tooltip" data-placement="top" title="Ver Crédito"></span>
              </a>
              <a href="{{route('start.facturas.create',$factura->credito->id)}}" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Hacer pago">
                <span class = "glyphicon glyphicon-usd"  ></span>
              </a>  
              @endif
              @permission('anular_pago_credito')
              <a href="#" class = 'btn btn-default btn-xs' OnClick="Anular({{$factura->id}},'{{$factura->num_fact}}');" data-toggle="modal" data-target="#modal" title="Anular factura">
                <span class = "glyphicon glyphicon-fire" ></span>
              </a>  
              @endpermission
              <a href="#" class = 'btn btn-default btn-xs' onclick="print('{{$factura->id}}')" title="Imprimir factura">
                <span class = "glyphicon glyphicon-print" ></span>
              </a>  
            </td>
          </tr>		

          @endforeach

          </tbody>
        </table>

        @include('start.facturas.anularFacturaModal')


      </div>
    </div>
  </div>
</div>

<div style="margin-left:30px;">
    {{ $facturas->links() }}
</div>

  @include('start.pagos.print_js')

  <script>
    $( document ).ready(function() {
      $('#datatable').dataTable( {
        'scrollY'       : 500,
        'paging'        : false,
        "scrollCollapse": true,
        "iDisplayLength": 500
      });
    });

    var Anular = function(factura_id, num_factura){ 
    $('#factura_id').val(factura_id);
    $('#num_fact').val(num_factura);
    $('#titulo').text('Escriba el motivo por el que va a  anular la factura '+num_factura);   
    $('#motivo_anulacion').val("");
    }
  </script>




@endsection
@include('templates.main2')
