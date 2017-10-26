@section('title','Pagos')
@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>
        Pagos Créditos
        <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button>
      </h2>  
    </div>
    <div class="panel-body">
        <p>
         @include('flash::message')
       </p>
       <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr>
            <th style="display:none;">    Actualizacion  </th>
              <th>    Pago id   </th>
              <th>    Factura número    </th>
              <th>    Cartera id  </th>
              <th>    Credito id  </th>
              <th>    Fecha     </th>
              <th>    Concepto  </th>
              <th>    Desde     </th>
              <th>    Hasta     </th>              
              <th>    Abono     </th>
              <th>    Debe      </th>
              <th>    Estado    </th>
              <th>    Abono a   </th>
              <th>    Cliente   </th>
              <th>    Documento    </th>           
              <th>    Acción        </th>
            </tr>
          </thead>

          <tbody>
          @foreach($pagos as $pago)
          <tr>
              
              <td style="display:none;"> {{$pago->created_at}}</td>
              <td> {{ $pago->id}}</td>
              <td> {{ $pago->factura->id    }}  </td>
              <td>{{$pago->factura->credito->precredito->cartera->nombre}}</td>
              <td> {{ $pago->credito->id    }}  </td>
              <td> {{ $pago->factura->fecha }}  </td>
              <td> {{ $pago->concepto       }}  </td>
              <td> {{ $pago->pago_desde     }}  </td>
              <td> {{ $pago->pago_hasta     }}  </td>
              <td  align="right"> {{ number_format($pago->abono,0,",",".")        }}  </td>
              <td  align="right"> {{ number_format($pago->debe,0,",",".")           }}  </td>
              <td> {{ $pago->estado         }}  </td>
              <td> {{ $pago->abono_pago_id}}</td>
              <td> <small>{{ $pago->credito->precredito->cliente->nombre }}</small></td>
              <td align="right"> {{ $pago->credito->precredito->cliente->num_doc }}</td>

              <td> 
              <a href="{{route('start.facturas.show',$pago->factura->id)}}" class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-eye-open"  data-toggle="tooltip" data-placement="top" title="Ver"></span></a>
              <a href="{{route('start.clientes.show',$pago->credito->precredito->cliente->id)}}" class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-user"  data-toggle="tooltip" data-placement="top" title="Ver cliente"></span></a> 

             
            </td>
          </tr>   

          @endforeach


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

  <script>
    $( document ).ready(function() {
      $('#datatable').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  
        'scrollY': 400,
        "scrollCollapse": true
      });
    });

    function Exportar(){
      $('#datatable').table2excel({
        name: 'pagos',
        filename: "pagos.xls"
      });
    }
  </script>



@endsection
@include('templates.main2')