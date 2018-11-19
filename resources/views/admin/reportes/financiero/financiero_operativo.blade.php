@section('title','reporte general')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Financiero Operativo 
       
            <!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-xs dropdown-toggle" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reportes adicionales <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="{{ url('repor-financiero-sucursales'.'/'.$rango['ini'].'/'.$rango['fin'])}}" target="_blank">
                  Financiero por sucursales</a>
                </li>
                <li><a href="{{ url('repor-financiero-tipo-creditos-sucursal-anual/'.$rango['ini'])}}" target="_blank">
                  Tipo de creditos por sucursal</a>
                </li>
                <li><a href="{{route('reporte.financiero.comparativo','2018')}}" target="_blank">Comparativa anual por trimestres</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
       
      </div>
        <div class="panel-body">


          <div class="row">
            <div class="col-xs-2  col-md-2 ">
              <div class="thumbnail">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <span class="badge"><small>{{$rango['ini'].' - '.$rango['fin']}}</small></span>
                      .
                    </li>
                    <li class="list-group-item" style="padding: 3px 15px;">
                      <span class="badge">{{ $info['num_creditos'] }}</span>
                      # cdts: 
                    </li> 
                    <li class="list-group-item" style="padding: 3px 15px;">
                      <span class="badge">
                        ${{  number_format($info['vlr_fin_total'] / $info['num_creditos'] ,0,'.','.') }}
                      </span>
                      % Cost
                    </li>  
                    <li class="list-group-item" style="padding: 3px 15px;">
                      <span class="badge">
                        ${{  number_format($info['vlr_a_recaudar'] / $info['num_creditos'] ,0,'.','.') }}
                      </span>
                      % x negocio
                    </li>
                    <li class="list-group-item" style="padding: 3px 15px;">
                      <span class="badge">
                        ${{  number_format($info['ingreso_esperado'] / $info['num_creditos'] ,0,'.','.') }}
                      </span>
                       % Margen bruto                    
                     </li>                              
                  </ul>
              </div>
            </div>
            <div class="col-xs-10 col-md-10">
              <a href="#" class="thumbnail">
                <div id="chart_div"></div>
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-4 col-md-4">
              <div href="#" class="thumbnail">
                <div id="piechart"></div>
              </div>
            </div>
            <div class="col-xs-4 col-md-4">
              <a href="#" class="thumbnail">
                <div id="recaudos_por_tipo"></div>
              </a>
            </div>
            <div class="col-xs-4 col-md-4">
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

@include('admin.reportes.financiero.graficas.financiero_operativo_js')
@include('admin.reportes.financiero.graficas.extras_js')
@include('admin.reportes.financiero.graficas.barras_js')
@include('admin.reportes.financiero.graficas.recaudos_por_tipo_js')

@endsection
@include('templates.main2')


