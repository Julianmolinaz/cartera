@section('title','ver factura solicitud')

@section('contenido')



<div class="row" id="element">
  <div class="col-md-1 col-sm-1"></div>

  <!--Panel Precredito-->
  <div class="col-md-10 col-sm-10 col-xs-12">

    <div class="panel panel-default">
      <div class="panel-heading">Factura Solicitud</div>
      @include('flash::message')

      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>    #         </th>        
                <th>    Cliente   </th>
                <th>    Solicitud id </th>
                <th>    # Factura </th>
                <th>    Fecha     </th>
                <th>    Total     </th>
                <th>    Creó      </th>
                <th>    Actividad    </th>

              </tr>
            </thead>

            <tbody>
              <tr>
                <td> {{ $factura->id }}    </td>
                <td> {{ $factura->precredito->cliente->nombre }} </td>
                <td> {{ $factura->precredito->id }} </td>
                <td> {{ $factura->num_fact }}</td>
                <td> {{ $factura->fecha }}</td>
                <td> {{ number_format($factura->total,0,",",".") }}</td>
                <td> {{ $factura->user_create->name.' '.$factura->created_at }} </td>
                <td>
                @permission('anular_pago_solicitud')
                  <a href="#" class = 'btn btn-default btn-xs' title="anular factura" 
                    OnClick="Anular({{$factura->id}},'{{$factura->num_fact}}');" data-toggle="modal" data-target="#modal">
                    <span class = "glyphicon glyphicon-fire"  ></span>
                  </a>
                @endpermission  
                    <a href="#" class='btn btn-default btn-xs' @click="print('{{$factura->id}}')">
                    <span class = "glyphicon glyphicon-print" title="Imprimir"></span>
                    </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      <a href="javascript:window.history.back();">
        <button class="btn btn-default" id="btn_volver" style="margin-right: 5px; ">
        <i class="glyphicon glyphicon-arrow-left"></i>&nbsp;&nbsp;Volver&nbsp;&nbsp;
        </button>
      </a>


    </div>
  </div>
</div>
<div class="col-md-1 col-sm-1"></div>
</div>

@include('start.pagos.print_js')






<div class="row">
  <div class="col-md-1 col-sm-1"></div>

  <!--Panel Precredito-->
  <div class="col-md-10 col-sm-10 col-xs-12">

    <div class="panel panel-default">
      <div class="panel-heading">Pagos</div>
      @include('flash::message')


      <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>   id         </th>
                  <th>   Concepto   </th>
                  <th>   Abono      </th>
                </tr>
              </thead>

              <tbody>

              @foreach( $factura->pagos as $pago)
              <tr>
                <td> {{ $pago->id}}</td>
                <td> {{ $pago->concepto->nombre }}     </td>
                <td align="right"> {{ number_format($pago->subtotal,0,",",".") }}  </td>
              </tr>
              @endforeach

              </tbody>
            </table>
          </div>
        @include('start.precred_pagos.anularFacturaModal')

       <a href="javascript:window.history.back();">
        <button class="btn btn-default" id="btn_volver" style="margin-right: 5px; ">
        <i class="glyphicon glyphicon-arrow-left"></i>&nbsp;&nbsp;Volver&nbsp;&nbsp;
        </button>
      </a>

      </div>
    </div>
  </div>

  <div class="col-md-1 col-sm-1"></div>

</div>

<script>
  var Anular = 
  function(factura_id, num_factura){ 
    $('#factura_id').val(factura_id);
    $('#num_fact').val(num_factura);
    $('#titulo').text('Escriba el motivo por el que va a  anular la factura '+num_factura);   
    $('#motivo_anulacion').val("");
    }
</script>
<script>

const element = new Vue({
  el:  '#element',
  methods: {
    print(factura_id){
      var self = this
      var route = "{{ url('start/precredito-invoice-print') }}/" + factura_id
      axios.get(route).then(function(res){
        self.print_html(res.data)
      })
    },//.print
    print_html(str){
      var printed = window.open('','Print-Window');
      printed.document.write(str);
      printed.document.close();
      printed.print();
      printed.close();
    }//.print_html
  }
});
</script>
@endsection

@include('templates.main2')


