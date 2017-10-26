@section('title','solicitud')

@section('contenido')

<div class="" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

        <table id="datatable" data-order='[[ 6, "desc" ]]' class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>    #         </th>
              <th>    Crédito id</th>
              <th>    # Factura </th>
              <th>    Fecha     </th>
              <th>    Total     </th>
              <th>    Creó      </th>
              <th style="display:none;">    Actualizacion  </th>
              <th>    *    </th>

            </tr>
          </thead>

          <tbody>
          @foreach($precredito->credito->facturas as $factura)
          <tr>
              <td> {{ $factura->id }}    </td>
              <td> {{ $factura->credito_id}} </td>
              <td> {{ $factura->num_fact }}</td>
              <td> {{ $factura->fecha }}</td>
              <td> {{ $factura->total }}</td>
              <td> {{ $factura->user_create->name.' '.$factura->created_at }} </td>
              <td style="display:none;"> {{$factura->updated_at}}</td>
              <td>
              <a href="{{route('start.pagos.show',$factura->id)}}" 
                class = 'btn btn-default btn-xs'>
                <span class = "glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Ver detalle"></a>
              <a href="{{route('start.facturas.create',$factura->credito->id)}}" class = 'btn btn-default btn-xs'>
              <span class = "glyphicon glyphicon-usd"  data-toggle="tooltip" data-placement="top" title="Hacer pago"></a>
             
            </td>
          </tr>

          @endforeach


          </tbody>
        </table>
      </div>








    </div>
  </div>
</div>
</div>


@endsection
@section('proceso','Crear cliente')
@include('templates.main')
