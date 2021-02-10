@section('title','Pagos')
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


        <center>
           <button type="submit" class="btn btn-primary">&nbsp;&nbsp;Generar Reporte&nbsp;&nbsp;</button>
        </center>  
   
      </form>
      </div>  
    </div>
  </div>
  <div class="col-xs-3 col-md-3"></div>
</div>  


<center>
  <div class="product_image">
   <img src="{{asset('images/logo_gora_2021.png')}}" alt="..." width="300">
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