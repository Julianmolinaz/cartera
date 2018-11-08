
<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Cartera', 'Pesos', { role: 'style' } ],
        ['Ideales', {!! $info['total_debe_vlr_fin_creditos_ideales']  !!}, 'color: yellow'],
        ['Promedio',{!! $info['total_debe_vlr_fin_creditos_promedio'] !!}, 'color: green'],
        ['0 - 1 pago', {!! $info['total_debe_vlr_fin_creditos_0_1_pago'] !!}, 'color: blue']
      ]);


      var options = {
        title: 'Cartera por tipo de clientes',
        hAxis: {
          title: 'Conceptos'
        },
        vAxis: {
          title: 'Escala en pesos'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('recaudos_por_tipo'));

      chart.draw(data, options);
    }

</script>