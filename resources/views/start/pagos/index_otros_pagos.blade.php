 @section('title','otros ingresos')
@section('contenido')


 <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="panel panel-danger">
          <div class="panel-heading">
            <h2>
              Ver Otros Ingresos
              <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button>
            </h2>
          </div>
          <div class="panel-body">
            <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
              <thead>
                <tr>
                  <th style="display:none;">    Creacion  </th>
                  <th>Factura número</th>
                  <th>Pago id</th>
                  <th>Fecha</th>
                  <th>Concepto</th>
                  <th>Cantidad</th>
                  <th>Valor Unitario</th>
                  <th>Subtotal</th>
                  <th>Total</th>
                  <th>Tipo de pago</th>
                  <th>Creó</th>
                  <th>Cartera</th>
                </tr>
              </thead>
              <tbody>
                @foreach($otros_pagos as $otro_pago)
                <tr>
                  <td style="display:none;"> {{$otro_pago->created_at}}</td>
                  <td>{{ $otro_pago->factura->num_fact }}</td>
                  <td>{{ $otro_pago->id}}</td>
                  <td>{{ $otro_pago->factura->fecha}}</td>
                  <td>{{ $otro_pago->concepto }}</td>
                  <td>{{ $otro_pago->cantidad }}</td>
                  <td align="right">{{ number_format($otro_pago->valor_unitario,0,",",".") }}</td>
                  <td align="right">{{ number_format($otro_pago->subtotal,0,",",".") }}</td>
                  <td align="right">{{ number_format($otro_pago->factura->total,0,",",".") }}</td>
                  <td>{{ $otro_pago->factura->tipo }}</td>
                  <td>{{ $otro_pago->factura->user_create->name.' ('.$otro_pago->created_at.')'}}</td>
                  <td> {{ $otro_pago->cartera->nombre }}</td>
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
        name: 'otros_ingresos',
        filename: "otros_ingresos.xls"
      });
    }
  </script>

@endsection
@include('templates.main2')