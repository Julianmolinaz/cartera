<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Extras', 'Pesos', { role: 'style' } ],
        ['Sanciones', {!! $info['vlr_recaudado_en_sanciones'] !!}, 'color: #2E64FE'],
        ['Prejurídico',{!! $info['vlr_recaudado_prejuridico'] !!}, 'color: #FF4000'],
        ['Jurídico', {!! $info['vlr_recaudado_juridico'] !!}, 'color: #01DF01']
      ]);


      var options = {
        title: 'Extras',
        hAxis: {
          title: 'Conceptos'
        },
        vAxis: {
          title: 'Escala en pesos'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('extras'));

      chart.draw(data, options);
    }

</script>