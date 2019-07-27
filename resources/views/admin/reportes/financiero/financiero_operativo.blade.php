@section('title','reporte general')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Financiero Operativo {{ ($sucursal) ? $sucursal :'' }}
        
      </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-2  col-md-2">
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
          <div class="row">
            <div class="col-md-12">

            <div class="row">
              <div class="col-xs-6 col-md-6">
                <div href="#" class="thumbnail">

                  <table class="table">
                    <thead>
                    
                      <tr>
                        <th>Concepto</th>
                        <th>Valor</th>
                        <th>Check </th>
                      </tr>

                    </thead>
                    <tbody>
                      @foreach($egresos_por_concepto as $element)
                        <tr>
                          <td style="padding:0px 10px;">{{ $element->concepto }}</td>
                          <td style="padding:0px 10px;" align="right">
                            {{ number_format($element->valor,0,",",".") }}
                          </td>
                          <td style="padding:0px 10px;" align="center">
                            <input type="checkbox" id="{{str_replace(' ','',$element->concepto)}}" 
                              onclick="set_value('{{str_replace(' ','',$element->concepto)}}','{{ $element->valor }}')">
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
        

                </div>
              </div>
              <div class="col-xs-6 col-md-6">
                <div href="#" class="thumbnail" style="padding: 50px 20px;"> 

                      <h1>Total Egresos</h1>
                      <h3><label id="total_egresos"></label></h3>
                    
            
                        <div class="progress">
                          <div id="dynamic" class="progress-bar progress-bar-primary progress-bar-striped active" 
                            role="progressbar" aria-valuenow="0" aria-valuemin="0" 
                            aria-valuemax="100" style="width: 0%">
                            <span id="current-progress"></span>
                          </div>
                        </div>

                </div>
              </div>
            </div>

            </div>
          </div>
                   
    </div>
  </div>
</div> 
</div>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<script>
  var total_egresos;
  var contenedor    = 0;

  var sumatoria_egresos = parseInt("{{ $total_egresos }}");

  function set_value(concepto, valor)
  {
    var check = $('#'+concepto).prop('checked');

    if( check ){
      contenedor += parseInt(valor);
    } 
    else {
      contenedor -= parseInt(valor);
    }
    
    var progress = 100 * contenedor / sumatoria_egresos

    interval(progress);

    total_egresos = miles(contenedor);

    console.log(total_egresos);
    
    
    $('#total_egresos').text('$ '+total_egresos);
  }

  var current_progress = 0;

  var interval = function(progress) {

      current_progress = progress.toFixed(2);
      $("#dynamic")
      .css("width", current_progress + "%")
      .attr("aria-valuenow", current_progress)
      .text(current_progress + "% Complete");

    };

  function miles(numero) {

    var str = numero.toString();
    

    var resultado = "";
    // Ponemos un punto cada 3 caracteres
    for (var j, i = str.length - 1, j = 0; i >= 0; i--, j++)
      resultado = str.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + resultado;

    return resultado;

  }

</script>


@include('admin.reportes.financiero.graficas.financiero_operativo_js')
@include('admin.reportes.financiero.graficas.extras_js')
@include('admin.reportes.financiero.graficas.barras_js')
@include('admin.reportes.financiero.graficas.recaudos_por_tipo_js')

@endsection
@include('templates.main2')


