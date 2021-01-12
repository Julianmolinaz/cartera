
@section('title','reporte general')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Financiero por sucursales {{$year}}</div>
        <div class="panel-body">

          <!-- CARACTERISTICAS GENERALES -->
          <div class="col-md-4">
            @foreach($quarts['q1'] as $quart)
            
              <div class="col-xs-12 col-md-12">
                <a href="#" class="thumbnail">
                  <div id="{{ $quart['sucursal']['id'] }}"></div>
                </a>
              </div>

          @endforeach
          </div>

        <!-- CARTERA POR TIPO DE CLIENTES -->
        <div class="col-md-4">                  
         
        </div>

        <!-- EXTRAS -->
          <div class="col-md-4">
        
        </div>
     </div>   
    </div>
  </div>
</div> 
</div>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
var count = 0;

@foreach( $quarts['q1'] as $quart )
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  var drawChart = function() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Sales', 'Expenses', 'Profit'],
      [
        '2014', 
        "{{ ($quart['info'] != '0 creditos') ? $quart['info']['vlr_fin_total']: 0 }}", 
        400, 
        200
        ],
      ['2015', 1170, 460, 250],
      ['2016', 660, 1120, 300],
      ['2017', 1030, 540, 350]
    ]);

    var options = {
      chart: {
        title: 'Company Performance',
        subtitle: 'Sales, Expenses, and Profit: 2014-2017',
      }
    };

    var chart = new google.charts.Bar(document.getElementById("{{ $quart['sucursal']['id'] }}"));

    chart.draw(data, google.charts.Bar.convertOptions(options));

    count++;
  }
@endforeach

</script>

@endsection
@include('templates.main2')


