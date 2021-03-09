

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Creditos', 'Cantidad de creditos'],
          ['Ideales '+{!! $info['porcien_ideales'] !!} +'%\n'+
            {!! $info['creditos_ideales'] !!} + ' cdts ',{!! $info['porcien_ideales'] !!}],
          ['Promedio '+{!! $info['porcien_promedio'] !!} +'%\n'+
            {!! $info['creditos_promedio'] !!} + ' cdts ',    {!! $info['porcien_promedio'] !!}],
          ['0 - 1 pago '+{!! $info['porcien_0_1_pago'] !!}+'%\n'+
            {!! $info['creditos_0_1_pago'] !!} + ' cdts ',  {!! $info['porcien_0_1_pago'] !!}]
        ]);

        var options = {
          title: 'Tipo de creditos',
          slices:{
            0:{color: 'green'},
            1:{color: 'orange'},
            2:{color: 'red'}
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>