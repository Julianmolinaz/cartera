@section('title','reporte general')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Financiero Operativo [ {{$rango['ini'].' - '.$rango['fin']}} ] 
        <button id="sucursales" class="btn btn-default"><b>Financiero por sucursales</b></button></div>
        <div class="panel-body">


          <div class="row">
            <div class="col-xs-4 col-md-4">
              <a href="#" class="thumbnail">
                <div id="piechart"></div>
              </a>
            </div>
            <div class="col-xs-8 col-md-8">
              <a href="#" class="thumbnail">
                <div id="chart_div"></div>
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-6 col-md-6">
              <a href="#" class="thumbnail">
                <div id="recaudos_por_tipo"></div>
              </a>
            </div>
            <div class="col-xs-6 col-md-6">
              <a href="#" class="thumbnail">
                  <span id="extras"></span>
              </a>
            </div>
          </div>
                   
    </div>
  </div>
</div> 
</div>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $("#sucursales").click(function(){
      window.open("{{url('repor-financiero-sucursales')}}/"+ "{{$rango['ini']}}" +"/"+ "{{$rango['fin']}}" , '_blank');
    });
</script>

@include('admin.reportes.financiero.graficas.financiero_operativo_js')
@include('admin.reportes.financiero.graficas.extras_js')
@include('admin.reportes.financiero.graficas.barras_js')
@include('admin.reportes.financiero.graficas.recaudos_por_tipo_js')

@endsection
@include('templates.main2')


