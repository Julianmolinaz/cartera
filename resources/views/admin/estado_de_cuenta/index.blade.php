@section('title','Estado de cuenta')

@section('contenido')

<div class="col-md-8 col-md-offset-2">
  <div class="panel panel-default">
    <div class="panel-heading" style="background-color:gray;color:white">
      <h3 class="panel-title">Estado de Cuenta</h3>
    </div>
    <div class="panel-body">
      
      <table class="table table-bordered" style="font-size:10px;">

              <tr style="background:gray; color:white;">
                  <th colspan="6">Cliente</th>
                  <th>Tipo documento</th>
                  <th colspan="3">Documento</th>
              </tr>
              <tr>
                  <td colspan="6">{{ $cuenta['nombre'] }}</td>
                  <td>{{ $cuenta['tipo_doc'] }}</td>
                  <td colspan="3">{{ $cuenta['num_doc'] }}</td>
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
                  <td colspan="2">{{ $cuenta['fecha_creacion'] }}</td>
                  <td colspan="2">{{ $cuenta['referencia'] }}</td>
                  <td colspan="2">{{ $cuenta['periodo'] }}</td>
                  <td>{{ miles($cuenta['vlr_cuota']) }}</td>
                  <td>{{ $cuenta['num_cts'] }}</td>
                  <td>{{ $cuenta['dias_de_pago'] }}</td>
                  <td>{{ miles($cuenta['vlr_credito']) }}</td>
              </tr>
      </table>
      <table class="table table-bordered" style="font-size:10px;">
          <!-- PAGOS -->
          <tr style="background:gray; color:white;">
              <th>Fecha de pago</th>
              <th>Factura</th>
              <th>Abonos</th>
              <th>Días de atrazo</th>
              <th>Mora</th>
              <th>Prejuridico</th>
              <th>Juridico</th>
              <th>Valor Factura</th>
              <th>Total a Pagar</th>
              <th>Saldo</th>
          </tr>
          @foreach($cuenta['pagos'] as $pago)
          <tr>
              <td>{{ $pago['fecha'] }}</td>
              <td align="right">{{ $pago['num_fact'] }}</td>
              <td align="right">{{ miles($pago['abonos$']) }}</td>
              <td align="right">{{ $pago['sancionesNo'] }}</td>
              <td align="right">{{ miles($pago['sanciones$']) }}</td>
              <td align="right">{{ miles($pago['prejuridico$']) }}</td>
              <td align="right">{{ miles($pago['juridico$']) }}</td>
              <td align="right">{{ miles($pago['factura_total']) }}</td>
              <td align="right">{{ miles($pago['total_a_pagar']) }}</td>
              <td align="right">{{ miles($pago['saldo']) }}</td>
          </tr>
          @endforeach
    
        <!-- TOTALES -->
         <tr>
            <td style="background:gray; color:white;" colspan="2">TOTALES</td>
            <td style="background:gray; color:white;" align="right">{{ miles($cuenta['total_abonos$']) }}</td>
            <td style="background:gray; color:white;" align="right">{{ miles($cuenta['total_sancionesNo']) }}</td>
            <td style="background:gray; color:white;" align="right">{{ miles($cuenta['total_sanciones$'])}}</td>
            <td style="background:gray; color:white;" align="right">{{ miles($cuenta['total_prejuridico$'])
            }}</td>
            <td style="background:gray; color:white;" align="right">{{ miles($cuenta['total_juridico$'])}}</td>
            <td style="background:gray; color:white;" align="right">{{ miles($cuenta['total_facturas'])}}</td>
            <td style="background:gray; color:white;"></td>
            <td style="background:gray; color:white;"></td>
          </tr>
      </table>

      <button class="btn btn-default" style="background:gray;color:white;color-border:gray;border-radius:0px;border-color: #808080;">PDF A4</button>
      <button class="btn btn-default" style="background:gray;color:white;color-border:gray;border-radius:0px;border-color: #808080;">PDF 58 mm</button>
    </div>
  </div>

</div>


@endsection
@include('templates.main2')