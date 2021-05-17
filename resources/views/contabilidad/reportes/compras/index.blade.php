@section('title','Recibos de Caja')
@section('contenido')

<div class="row">
  <div class="col-xs-3 col-md-3"></div>
  <div class="col-xs-6 col-md-6">
    <div class="row">
      <div class="col-xs-12 col-md-12">

        <center>
            <h1>Compras.</h1>
            <hr>
        </center>
      <p>
        @include('flash::message')
        @include('templates.error')
      </p>

        <form 
          class="form-horizontal form-label-left"  
          method="POST"
        >
      
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

          <div class="form-group">

            <div class="col-md-6 " id="range">
              <input 
                type="text" 
                name="daterange" 
                id="daterange" 
                class="form-control"
              >  
            </div>

            <div class="form-group" id="" style=""> 
                <div class="col-md-3"></div>
                    <div class="col-md-6" id="" >
                        <input  
                            type="numeric" 
                            id="consecutivo" 
                            name="consecutivo" 
                            class="form-control" 
                            placeholder="Consecutivo"> 
                    </div>
            </div>

        </div>  
      
        <center>
           <button type="submit" 
                  style="margin-top: 15px;" 
                  class="btn btn-primary">
                  &nbsp;&nbsp;Generar Reporte&nbsp;&nbsp;
            </button>
            <button type="submit" 
                  style="margin-top: 15px;" 
                  class="btn btn-success">
                  &nbsp;&nbsp;Exportar Reporte&nbsp;&nbsp;
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
 
</script>


@endsection
@include('templates.main2')