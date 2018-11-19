<script>

/*grafica que muestra la sumatoria de 
valor a financiar , ingreso esperado,valor a recaudar,recaudo en cuotas, total cartera*/


google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        [ 
          'Colocación', 
          'Pesos', { role: 'style' }, {role: 'annotation'} 
          ],
        [
          'V. financiar', {!! $info['vlr_fin_total'] !!}, 'color: #d20962',
            '{{ number_format($info["vlr_fin_total"],0, ",",".") }}' 
          ],
        [
          'Ing. esperado', {!! $info['ingreso_esperado'] !!}, 'color: #f47721',
          '{{ number_format( $info['ingreso_esperado'],0, ",",".") }}'
          ],
        [
          'V. reacaudar',{!! $info['vlr_a_recaudar'] !!}, 'color: #7d3f98',
          '{{ number_format($info['vlr_a_recaudar'],0, ",",".") }}'
          ],
        [
          'Recaudo cuotas', {!! $info['vlr_recaudado_en_cuotas'] !!}, 'color: #00a78e',
          '{{ number_format( $info['vlr_recaudado_en_cuotas'],0, ",",".") }}'
          ],
        [
          'Recaudo pendiente', {!! $info['total_pendiente_para_cubrir_vlr_a_recaudar'] !!}, 'color: #00bce4',
          '{{ number_format( $info['total_pendiente_para_cubrir_vlr_a_recaudar'],0, ",",".") }}'
          ],
        [
          'Total cartera', {!! $info['total_costo_cartera'] !!}, 'color: red',
          '{{ number_format( $info['total_costo_cartera'],0, ",",".") }}'
          ]
      ]);


      var options = {
        title: 'Colocación',
        hAxis: {
          title: 'Conceptos'
        },
        vAxis: {
          title: 'Escala en pesos'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));
        chart.draw(data, options);
    }

</script>