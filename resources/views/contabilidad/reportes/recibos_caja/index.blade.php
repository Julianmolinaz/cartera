@section('title','Recibos de Caja')
@section('contenido')

<div class="row">
  <div class="col-xs-3 col-md-3"></div>
  <div class="col-xs-6 col-md-6">
    <div class="row">
      <div class="col-xs-12 col-md-12">

        <center>
            <h1>Recibos de Caja.</h1>
            <a class="btn" href="{{route('contabilidad.reportes.index')}}" style="margin-top:-21px;">Volver</a>
        </center>
      <p>
        @include('flash::message')
        @include('templates.error')
      </p>

        <form 
          id="form"
          class="form-horizontal form-label-left"  
          method="POST"
          autocomplete="off"
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
                            placeholder="Consecutivo *"> 
                    </div>
            </div>

        </div>  

        <div class="form-group" id="" style="">
            <div class="col-md-6"></div>
                <div class="col-md-6 col-md-offset-3" id="" >
                  <textarea 
                      id="terceros" 
                      name="terceros" 
                      class="form-control" 
                      placeholder="Terceros"></textarea>
                    <center>
                        <p class="help-block"><small>Ejemplo: 110000000,12726020,102220003</small></p>
                    </center>   
                </div>
            </div>
      
        <center>
           <button 
                  id="btn-previsualizar"
                  type="submit" 
                  style="margin-top: 15px;" 
                  class="btn btn-primary">
                  &nbsp;&nbsp;Previsualizar&nbsp;&nbsp;
            </button>
            <button 
                  id="btn-exp"
                  type="submit" 
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
    <img style="width:300px; margin-top: 30px;" src="{{asset('images/logo_gora_2021.png')}}" alt="...">
  </div> 
</center>
            



<script type="text/javascript">

$(function() {

  $('input[name="daterange"]').daterangepicker({
   locale: { format: 'DD/MM/YYYY' }
  });

});

class Main {

    constructor() {

        // Atributos
        this.btnPrev = document.querySelector('#btn-previsualizar');
        this.btnExp  = document.querySelector('#btn-exp');
        this.form    = document.querySelector('#form');

        // Eventos
        this.btnPrev.addEventListener('click', (event) => {
            event.preventDefault();
            this.getPrev();
        });
        this.btnExp.addEventListener('click', (event) => {
            event.preventDefault();
            this.getExp();
        });
    }
    getPrev() {
        this.form.action = '/contabilidad/reportes/recibos_caja/list';
        this.form.submit();
    }
    getExp() {
        this.form.action = '/contabilidad/reportes/recibos_caja/exp';
        this.form.submit();
    }
}
new Main();
 
</script>


@endsection
@include('templates.main2')