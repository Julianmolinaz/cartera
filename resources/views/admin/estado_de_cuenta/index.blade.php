@section('title','Estado de cuenta')

@section('contenido')

<div class="col-md-8 col-md-offset-2">
  <div class="panel panel-default">
    <div class="panel-heading" style="background-color:gray;color:white">
      <h3 class="panel-title">Estado de Cuenta / {{$now}}</h3>
    </div>
    <div class="panel-body">
      
      <table class="table table-bordered" style="font-size:10px;" id="info">

              <tr style="background:gray; color:white;">
                  <th colspan="6">Cliente</th>
                  <th>Tipo documento</th>
                  <th colspan="3">Documento</th>
              </tr>
              <tr>
                  <td colspan="6">{{ $data['cliente']['nombre'] }}</td>
                  <td>{{ $data['cliente']['doc_type'] }}</td>
                  <td colspan="3">{{ $data['cliente']['num_doc'] }}</td>
              </tr>
              <tr style="background:gray; color:white;">
                  <th colspan="2">Fecha del Crédito</th>
                  <th colspan="2">Referencia</th>
                  <th colspan="2">Periodo</th>
                  <th>Vlr Cuota</th>
                  <th># Cuotas</th>
                  <th>Dias de Pago</th>
                  <th>Valor del Crédito</th>
              </tr>
              <tr>
                  <td colspan="2">{{ $data['credito']['fecha_apertura'] }}</td>
                  <td colspan="2" align="right">{{ $data['credito']['id'] }}</td>
                  <td colspan="2" align="right">{{ $data['credito']['periodo'] }}</td>
                  <td align="right">${{ miles($data['credito']['vlr_cta']) }}</td>
                  <td align="right"s>{{ $data['credito']['num_cts'] }}</td>
                  <td align="right">{{ $data['credito']['dias_pago'] }}</td>
                  <td align="right">${{ miles($data['credito']['vlr_credito']) }}</td>
              </tr>
      </table>

      <table class="table table-bordered" style="font-size:10px;" id="estado">
          <!-- PAGOS -->
          <tr style="background:gray; color:white;">
              <th>Fecha</th>
              <th>Factura</th>
              <th>Valor Factura</th>  
              <th>Total a Pagar</th> 
              <th>Saldo</th>
              <th>Días mora</th>
              <th>Mora</th>
              <th>Abonos Cuota</th>
              <th>Abonos Cuota Parcial</th>
              <th>Prejuridico</th>
              <th>Juridico</th>
          </tr>
        <!-- TOTALES -->
        @foreach($data['items'] as $item)
          @if(isset($item['factura']))
          <tr>
            <th rowspan="{{count($item['factura']['pagos'])}}" align="right">{{ $item['factura']['fecha'] }}</th>
            <th rowspan="{{count($item['factura']['pagos'])}}" align="right">{{ $item['factura']['num'] }}</th>
            <td rowspan="{{count($item['factura']['pagos'])}}" align="right">${{ miles($item['factura']['valor']) }}</td>
            <td rowspan="{{count($item['factura']['pagos'])}}" align="right">${{ miles($item['estado']['total_pagar']) }}</td>
            <td rowspan="{{count($item['factura']['pagos'])}}" align="right">${{ miles($item['estado']['saldo']) }}</td>  
            @for($i = 0;  $i < count($item['factura']['pagos']); $i++)
              @if($i > 0)
              <tr>
              @endif
                <td align="right">{{ ($item['factura']['pagos'][$i]['concepto'] == 'Mora') ? $item['estado']['num_sanciones'] : ''}}</td>
                <td align="right" style="min-width:70px;">{{ ($item['factura']['pagos'][$i]['concepto'] == 'Mora') ? '$ '.miles($item['factura']['pagos'][$i]['valor']) :'' }}</td>
                <td align="right">{{ ($item['factura']['pagos'][$i]['concepto'] == 'Cuota') ? '$ '.miles($item['factura']['pagos'][$i]['valor']) :'' }}</td>
                <td align="right">{{ ($item['factura']['pagos'][$i]['concepto'] == 'Cuota Parcial') ? '$ '.miles($item['factura']['pagos'][$i]['valor']) :'' }}</td>
                <td align="right">{{ ($item['factura']['pagos'][$i]['concepto'] == 'Prejuridico') ? '$ '.miles($item['factura']['pagos'][$i]['valor']) :'' }}</td>
                <td align="right">{{ ($item['factura']['pagos'][$i]['concepto'] == 'Juridico') ? '$ '.miles($item['factura']['pagos'][$i]['valor']) :'' }}</td>     
              @if($i > 0)
              </tr>
              @endif
            @endfor
          </tr> 
          @else
          <tr style="background-color:gray;color:white">
            <th colspan="5">Total pagos</th>
            <td></td>
            <td align="right">${{ miles($data['totales']['total_sanciones']) }}</td>
            <td align="right">${{ miles($data['totales']['total_cuota']) }}</td>
            <td align="right">${{ miles($data['totales']['total_cuota_parcial']) }}</td>
            <td align="right">${{ miles($data['totales']['total_prejuridico']) }}</td>
            <td align="right">${{ miles($data['totales']['total_juridico']) }}</td>
          </tr> 
          <tr>
            <th colspan="3">Estado actual cuenta: {{ $now }}</th>
            <td align="right">${{ miles($item['estado']['total_pagar']) }}</td>
            <td align="right">${{ miles($item['estado']['saldo']) }}</td>
            <td align="right">{{ miles($item['estado']['num_sanciones']) }}</td>
            <td align="right">${{ miles($item['estado']['valor_sanciones']) }}</td>
            <td></td>
            <td></td>
            <td align="right">${{ miles($item['estado']['prejuridicos']) }}</td>
            <td align="right">${{ miles($item['estado']['juridicos']) }}</td>
          </tr>  
          @endif

        @endforeach
          <tr>
      </table>
      
      <a class="btn btn-default" 
        href="{{ route('admin.estado_cuenta.PDF', $data['credito']['id']) }}" target="_blank"
        style="background:gray;
               color:white;
               color-border:gray;
               border-radius:0px;
               border-color: #808080;">
        PDF A4
      </a>

      <button class="btn btn-default" 
        style="background:gray;
               color:white;
               color-border:gray;
               border-radius:0px;
               border-color: #808080;">
        PDF 58 mm
      </button>
    </div>
  </div>

</div>

<script>
  $('#btn_exc_detalle').click(function(){
    $('#info').table2excel({
      name: 'Reporte',
      filename: "info.xls"
    });
  });
</script>

@endsection
@include('templates.main2')