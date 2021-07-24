@section('title','reporte general')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Financiero por sucursales [ {{$rango['ini'].' - '.$rango['fin']}} ]</div>
        <div class="panel-body">

          <!-- CARACTERISTICAS GENERALES -->
          <div class="col-md-4">
            @foreach($sucursales as $sucursal)
              @if($sucursal['info'] != '0 creditos')
              <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                  <div id="{{ $sucursal['sucursal']['id'] }}"></div>
                </a>
              </div>
            @endif
          @endforeach
          </div>

        <!-- CARTERA POR TIPO DE CLIENTES -->
        <div class="col-md-4">                  
          @foreach($sucursales as $sucursal)
            @if($sucursal['info'] != '0 creditos')
              <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                  <div id="{{ 'b'.$sucursal['sucursal']['id'] }}"></div>
                </a>
              </div>
            @endif
          @endforeach
        </div>

        <!-- EXTRAS -->
          <div class="col-md-4">
          @foreach($sucursales as $sucursal)
            @if($sucursal['info'] != '0 creditos')
              <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                  <div id="{{ 'a'.$sucursal['sucursal']['id'] }}"></div>
                </a>
              </div>
            @endif
          @endforeach  
        </div>
     </div>   
    </div>
  </div>
</div> 
</div>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
@foreach( $sucursales as $sucursal )
@if($sucursal['info'] != '0 creditos')

google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);


var drawMultSeries = function () {
      var data = google.visualization.arrayToDataTable([
        [
          'Colocación', 'Pesos', { role: 'style' } , { role: 'annotation' }
          ],
        [
          'V. financiar', {!! $sucursal['info']['vlr_fin_total'] !!}, 'color: yellow',
          "{{ number_format($sucursal['info']['vlr_fin_total'],0,',','.') }}"
          ],
        [
          'Ing. esperado', {!! $sucursal['info']['ingreso_esperado'] !!}, 'color: blue',
          "{{ number_format($sucursal['info']['ingreso_esperado'] ,0,',','.') }}"
          ],
        [
          'V. reacaudar',{!! $sucursal['info']['vlr_a_recaudar'] !!}, 'color: green',
          "{{ number_format($sucursal['info']['vlr_a_recaudar'] ,0,',','.') }}"
          ],
        [
          'Rec. cuotas', {!! $sucursal['info']['vlr_recaudado_en_cuotas'] !!}, 'color: #58FAF4',
          "{{ number_format($sucursal['info']['vlr_recaudado_en_cuotas'] ,0,',','.') }}"
          ],
        [
          'T. cartera',{!! $sucursal['info']['total_costo_cartera'] !!}, 'color: red',
          "{{ number_format($sucursal['info']['total_costo_cartera'] ,0,',','.') }}"
          ],
        [
          'T. Egresos',{!! $sucursal['total_egresos'] !!}, 'color: gray',
          "{{ number_format($sucursal['total_egresos'] ,0,',','.') }}"
          ]  
      ]);


      var options = {
        title: 'Colocación',
        hAxis: {
          title: "{{ $sucursal['sucursal']['nombre'] }}"
        },
        vAxis: {
          title: 'Escala en pesos'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById("{{ $sucursal['sucursal']['id'] }}"));

      chart.draw(data, options);
    }

    google.charts.setOnLoadCallback(drawMultSeries2);

  var drawMultSeries2 = function() {
        var dato = google.visualization.arrayToDataTable([
          ['Extras', 'Pesos', { role: 'style' },{ role: 'annotation'} ],
          ['Sanciones', {!! $sucursal['info']['vlr_recaudado_en_sanciones'] !!}, 
            'color: #2E64FE',
            "{{ number_format($sucursal['info']['vlr_recaudado_en_sanciones'],0,',','.') }}"],
          ['Prejurídico',{!! $sucursal['info']['vlr_recaudado_prejuridico'] !!}, 
            'color: #FF4000', 
            "{{ number_format($sucursal['info']['vlr_recaudado_prejuridico'],0,',','.') }}"],
          ['Jurídico', {!! $sucursal['info']['vlr_recaudado_juridico'] !!}, 
            'color: #01DF01',
            "{{ number_format( $sucursal['info']['vlr_recaudado_juridico'] ,0,',','.') }}"]
        ]);


        var options2 = {
          title: 'Extras',
          hAxis: {
            title: "{{ $sucursal['sucursal']['nombre'] }}"
          },
          vAxis: {
            title: 'Escala en pesos'
          }
        };

        var chart2 = new google.visualization.ColumnChart(
          document.getElementById("{{ 'a'.$sucursal['sucursal']['id'] }}"));

        chart2.draw(dato, options2);
      }

    google.charts.setOnLoadCallback(drawMultSeries3);

    var drawMultSeries3 = function() {
          var data = google.visualization.arrayToDataTable([
            ['Cartera', 'Pesos', { role: 'style' },{ role: 'annotation'} ],
            ['Ideales', {!! $sucursal['info']['total_debe_vlr_fin_creditos_ideales']  !!}, 
              'color: yellow',
              "{{ number_format($sucursal['info']['total_debe_vlr_fin_creditos_ideales'] ,0,',','.') }}"],
            ['Promedio',{!! $sucursal['info']['total_debe_vlr_fin_creditos_promedio'] !!}, 
              'color: green',
              "{{ number_format($sucursal['info']['total_debe_vlr_fin_creditos_promedio'],0,',','.') }}"],
            ['0 - 1 pago', {!! $sucursal['info']['total_debe_vlr_fin_creditos_0_1_pago'] !!}, 
              'color: blue',
              "{{ number_format($sucursal['info']['total_debe_vlr_fin_creditos_0_1_pago'],0,',','.') }}"]
          ]);


          var options = {
            title: 'Cartera por tipo de clientes',
            hAxis: {
              title: '{{ $sucursal['sucursal']['nombre'] }}'
            },
            vAxis: {
              title: 'Escala en pesos'
            }
          };

          var chart = new google.visualization.ColumnChart(
            document.getElementById('{{ 'b'.$sucursal['sucursal']['id'] }}'));

          chart.draw(data, options);
        }      
@endif
@endforeach




</script>

@endsection
@include('templates.main2')


