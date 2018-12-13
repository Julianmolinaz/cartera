@section('title','Facturas Anuladas')
@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading"> <h2>Facturas Créditos Anuladas
        <i class="far fa-frown"></i></h2>
    </div>
    <div class="panel-body">
        <p>
         @include('flash::message')
         @include('templates.error')
       </p>
       <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:10px">
          <thead>
            <tr>
            <th style="display:none;">    Actualizacion  </th>            
              <th>    # Factura  </th>
              <th>    Cartera </th>
              <th>    Crédito id </th>
              <th>    Fecha      </th>
              <th>    Total      </th>
              <th>    Pagos      </th>
              <th>    Cliente    </th>
              <th>    # doc.     </th>
              <th>    Motivo Anulación</th>
              <th>    Creó       </th>  
              <th>    Anuló      </th>           

            </tr>
          </thead>

          <tbody>
            @foreach($anuladas as $anulada)
              <tr>
                <td style="display:none;"> {{ $anulada->created_at}}    </td>
                <td> {{ $anulada->num_fact}}                            </td>
                <td>{{ $anulada->credito->precredito->cartera->nombre}} </td>
                <td> {{ $anulada->credito_id}}                          </td>
                <td> {{ $anulada->fecha}}                               </td>
                <td> {{ number_format($anulada->total,0,",",".")}}      </td>
                <td> <small>{{ $anulada->pagos}}</small>                </td>
                <td> <small>{{ $anulada->cliente->nombre}}</small>      </td>
                <td> <small>{{ $anulada->cliente->num_doc}}</small>     </td>
                <td> {{ $anulada->motivo_anulacion}}                    </td>
                <td> {{ $anulada->user_create->name}}                   </td>
                <td> {{ $anulada->anula->name.' ['.$anulada->created_at.']'}}</td>
              </tr>
            @endforeach          
          </tbody>
        </table>


      </div>
    </div>
  </div>
</div>
<div style="margin-left:30px;">
    {{ $anuladas->links() }}
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


  </script>




@endsection
@include('templates.main2')