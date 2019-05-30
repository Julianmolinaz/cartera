@section('title','carteras')

@section('contenido')



<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="{{ asset('images/billetera.jpg') }}" style="height:215px;width:100%;">
      <div class="caption">
        <h3>Reporte por carteras</h3>
        <p>
          Reporte por cartera discriminado por c/u de los puntos (sucursales).
          En el reporte se encontrarán tres símbolos : 
          <br>
          <ul>
            <li>$: cartera en pesos : <span class="text-muted">(Al día + Mora + Prejurídico)</span></li>
            <li>#: cantidad de creditos: <span class="text-muted">∑ créditos</span></li>
            <li>%: indicador: 
              <small><span class="text-muted">(Total Criterio / Total Cartera) * 100 </span></small></li>
          </ul>
        </p>
        <p><a href="{{ route('admin.info_carteras') }}" class="btn btn-primary" role="button">Ver informe</a></p>
      </div>
    </div>
  </div>

    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="{{ asset('images/sucursales.jpg') }}" style="height:215px;width:100%;">
      <div class="caption">
        <h3>Reporte total por puntos</h3>
        <p>
          Reporte consolidado y discriminado por puntos (sucursales).
          En el reporte se encontrarán tres símbolos : 
          <br>
          <ul>
            <li>$: cartera en pesos : <span class="text-muted">(Al día + Mora + Prejurídico)</span></li>
            <li>#: cantidad de creditos: <span class="text-muted">∑ créditos</span></li>
            <li>%: indicador: 
              <small><span class="text-muted">(Total Criterio / Total Cartera) * 100 </span></small></li>
          </ul>
        </p>
        <p><a href="{{ route('admin.info_cartera_puntos') }}" class="btn btn-primary" role="button">Ver informe</a> 
      </div>
    </div>
  </div>




</div>


@endsection

@include('templates.main2')
