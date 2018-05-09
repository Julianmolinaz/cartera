@section('title','Reportes')
@section('contenido')

<div class="row">
  <div class="col-xs-3 col-md-3"></div>
  <div class="col-xs-6 col-md-6">
    <div class="row">
      <div class="col-xs-12 col-md-12">

      <p>
        @include('flash::message')
        @include('templates.error')
      </p>

        <form class="form-horizontal form-label-left" action="{{route('admin.reportes.store')}}" method="POST">
      
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

          <div class="form-group">

            <div class="col-md-6" id="range">
              <input type="text" name="daterange" id="daterange" class="form-control" value="" />  
            </div>

            <div id="periodo" style="display:none;" class="col-md-6">
              <div class="col-md-6">
                <select name="mes_corte" id="" class="form-control">
                  <option  disabled selected>- -</option>
                  <option value="1">Enero</option>
                  <option value="2">Febrero</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>

              <div class="col-md-6">
                <select name="ano_corte" id="" class="form-control">
                  <option disabled selected>- -</option>
                  @foreach(range($ano,2015) as $year)
                    <option value="{{$year}}">{{$year}}</option>
                  @endforeach
                </select>
              </div>  
            </div>



         <div class="col-md-6">
           <select name="tipo_reporte" id="tipo_reporte" class="form-control">
            <option readonly disabled selected>Tipo de Reporte</option>
              @foreach($tipo_reportes as $tipo)
                <option value="{{$tipo['value']}}">{{$tipo['vista']}}</option>
              @endforeach
           </select>
          </div>

        </div>  

        <div class="form-group">
          <div class="col-md-3"></div>
          <div class="col-md-6" id="carteras" style="display:none;">
            <select class="form-control" name="cartera">
              <option value="" disabled selected >Escoja una cartera</option>
              @foreach($carteras as $cartera)
                <option value="{{$cartera->id}}">{{ $cartera->nombre }}</option>
              @endforeach  
            </select>
          </div>
          <div class="col-md-3"></div>
        </div>
      
        <center>
           <button type="submit" class="btn btn-primary">&nbsp;&nbsp;Generar Reporte&nbsp;&nbsp;</button>
           <a href="{{route('admin.marcar_cancelados')}}" class="btn btn-success" id="btnCancelados">
              Marcar créditos finalizados {{ $ultimo_reporte_cancelados }}
          </a>
        </center>  
   
      </form>
      </div>  
    </div>
  </div>
  <div class="col-xs-3 col-md-3"></div>
</div>  


<center>
  <div class="product_image">
   <img src="{{asset('images/gora_logo.png')}}" alt="...">
  </div> 
</center>
            



<script type="text/javascript">


$(function() {

  ocultarCancelados();

  $('input[name="daterange"]').daterangepicker({
   locale: { format: 'DD/MM/YYYY' }
  });

  //alert()

  if($('#tipo_reporte').val() == "general_por_carteras"){
    mostrarCarteras();
  }

});

$('#tipo_reporte').on('change',function(){
  if( $('#tipo_reporte').val() == 'general_por_carteras' ){
      ocultarPeriodo();
      mostrarRange();
      mostrarCarteras();
      ocultarCancelados();
  }
  else if( $('#tipo_reporte').val() == 'datacredito' ){
    mostrarPeriodo()
    ocultarRange();
    ocultarCarteras();
    ocultarCancelados();
  }
  else if( $('#tipo_reporte').val() == 'procredito' ){
    ocultarPeriodo();
    //mostrarCancelados();
  }
  else{
    ocultarCarteras();
    ocultarPeriodo();
    mostrarRange();
    ocultarCancelados();
  }
});

var mostrarCarteras   = function(){  $('#carteras').show(); }
var ocultarCarteras   = function(){  $('#carteras').hide(); }
var mostrarRange      = function(){  $('#range').show();    }
var ocultarRange      = function(){  $('#range').hide();    }
var mostrarPeriodo    = function(){  $('#periodo').show()   }
var ocultarPeriodo    = function(){  $('#periodo').hide()   }
var mostrarCancelados = function(){  $('#btnCancelados').show(); } 
var ocultarCancelados = function(){  $('#btnCancelados').hide(); } 
</script>


@endsection
@include('templates.main2')