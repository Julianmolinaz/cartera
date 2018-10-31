<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Colocación', 'Pesos', { role: 'style' } ],
        ['V. financiar', {!! $info['vlr_fin_total'] !!}, 'color: yellow'],
        ['V. reacaudar',{!! $info['vlr_a_recaudar'] !!}, 'color: green'],
        ['Ing. esperado', {!! $info['ingreso_esperado'] !!}, 'color: blue'],
        ['Recaudo cuotas', {!! $info['vlr_recaudado_en_cuotas'] !!}, 'color: #58FAF4'],
        ['Total cartera', {!! $info['total_costo_cartera'] !!}, 'color: red']
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