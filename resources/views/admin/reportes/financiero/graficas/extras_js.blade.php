<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable([
        ['Extras', 'Pesos', { role: 'style' },{role: 'annotation'} ],
        ['Sanciones', {!! $info['vlr_recaudado_en_sanciones'] !!}, 'color: #FF5733',
          "{{number_format( $info['vlr_recaudado_en_sanciones'] ,0, ",",".") }}"],
        ['Prejurídico',{!! $info['vlr_recaudado_prejuridico'] !!}, 'color: #FF4000',
          "{{number_format($info['vlr_recaudado_prejuridico'] ,0, ",",".") }}"],
        ['Jurídico', {!! $info['vlr_recaudado_juridico'] !!}, 'color: #01DF01',
          "{{number_format($info['vlr_recaudado_juridico'] ,0, ",",".") }}"]
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