<script>

/*grafica que muestra la sumatoria de 
valor a financiar , ingreso esperado,valor a recaudar,recaudo en cuotas, total cartera 
y egresos*/


google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        [ 
          'Colocación', 
          'Pesos', { role: 'style' }, {role: 'annotation'} 
          ],
        [
          'Iniciales', {!! $info['iniciales'] !!}, 'color:#d2d2d2',
          '{{ number_format($info["iniciales"],0, ",",".") }}' 
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
          'Rec. cuotas', {!! $info['vlr_recaudado_en_cuotas'] !!}, 'color: #00a78e',
          '{{ number_format( $info['vlr_recaudado_en_cuotas'],0, ",",".") }}'
          ],
        [
          'Rec. pendiente', {!! $info['total_pendiente_para_cubrir_vlr_a_recaudar'] !!}, 'color: #00bce4',
          '{{ number_format( $info['total_pendiente_para_cubrir_vlr_a_recaudar'],0, ",",".") }}'
          ],
        [
          'T. cartera', {!! $info['total_costo_cartera'] !!}, 'color: red',
          '{{ number_format( $info['total_costo_cartera'],0, ",",".") }}'
          ],
        // [
        //   'T. egresos', {!! $total_egresos !!}, 'color: gray',
        //   '{{ number_format( $total_egresos,0, ",",".") }}'
        //   ]
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