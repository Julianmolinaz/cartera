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

        <form 
          class="form-horizontal form-label-left"  
          method="POST"
          action="{{ route('contabilidad.reportes.store') }}"
        >
      
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

          <div class="form-group">

            <div class="col-md-6" id="range">
              <input 
                type="text" 
                name="daterange" 
                id="daterange" 
                class="form-control"
              >  
            </div>


          <div class="col-md-6">
            <select name="report" id="report" class="form-control" onchange="verCamposAdicionales(event)">
                <option readonly disabled selected>Tipo de Reporte</option>
                @foreach($reports as $report)
                  <option value="{{ $report->id }}">{{ $report->name }}</option>
                @endforeach
            </select>
          </div>

        </div>  

        <div class="form-group">
          <div class="col-md-3"></div>
            <div class="col-md-6" id="" style="display:none;">
              <select class="form-control" name="">
                <option value="" disabled selected >Escoja una cartera</option> 
              </select>
            </div>
          <div class="col-md-3"></div>
        </div>
        

        <!-- Consecutivo -->

        <div class="form-group" id="form-group-consecutivo" style="display:none;">
          <div class="col-md-3"></div>
            <div class="col-md-6" id="" >
              <input type="numeric" id="consecutivo" name="consecutivo" class="form-control" placeholder="Consecutivo"> 
              <p class="help-block">Los registros se generarán a partir de este consecutivo.</p>
            </div>
          <div class="col-md-3"></div>
        </div>
      
        <center>
           <button type="submit" 
                  style="margin-top: 15px;" 
                  class="btn btn-primary">
                  &nbsp;&nbsp;Generar Reporte&nbsp;&nbsp;
            </button>
        </center>  
   
      </form>
      </div>  
    </div>
  </div>
  <div class="col-xs-3 col-md-3"></div>
</div>  


<center>
  <div class="product_image">
    <img style="width:400px; margin-top: 30px;" src="{{asset('images/logo_gora_2021.png')}}" alt="...">
  </div> 
</center>
            



<script type="text/javascript">

$(function() {

  $('input[name="daterange"]').daterangepicker({
   locale: { format: 'DD/MM/YYYY' }
  });

});


function verCamposAdicionales(event) {

    var consecutivo = document.querySelector('#form-group-consecutivo')

    switch (event.target.value) {
      case 'compras_soat_rtm':
        consecutivo.style.display = 'block';    
        break;
      case 'comprobante_ventas':
        consecutivo.style.display = 'block';    
        break;
      default:
      consecutivo.style.display = 'none';
        break;
    }
}
 
</script>


@endsection
@include('templates.main2')