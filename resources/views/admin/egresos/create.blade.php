@section('title','crear egreso')

@section('contenido')


<div class="row">

  <div class="col-md-4 col-sm-4 "></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">
      <div class="panel-heading">Crear Egreso</div>
      <div class="panel-body">

        @include('templates.error')
        @include('flash::message')


        <form class="form-horizontal form-label-left" action="{{route('admin.egresos.store')}}" method="POST">        

         <!-- fecha -->

         <div class="form-group">

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Fecha *: </label>
            <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha" name="fecha" value="{{old('fecha')}}">
          </div>

          <!-- comprobante_egreso -->

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for=""><small># Comprobante de Egreso *: </small></label>
            <input type="text" class="form-control input-sm" placeholder="#" id="comprobante_egreso" name="comprobante_egreso" value="{{old('comprobante_egreso')}}">
          </div>  

        </div>

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="">Cartera *: </label>
            <select class="form-control input-sm" id="cartera_id" name="cartera_id">
              <option disabled selected >- -</option>
              @foreach($carteras as $cartera)
              <option value="{{$cartera->id}}" {{ (old("cartera_id") == $cartera->id ? "selected":"") }}>{{$cartera->nombre}}</option>
              @endforeach  
            </select> 
          </div>  
        </div>  

         <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="">Punto *: </label>
            <select class="form-control input-sm" id="punto_id" name="punto_id">
              <option disabled selected >- -</option>
              @foreach($puntos as $punto)
              <option value="{{$punto->id}}" {{ (old("punto_id") == $punto->id ? "selected":"") }}>{{$punto->nombre}}</option>
              @endforeach  
            </select> 
          </div>  
        </div>  

        <div class="form-group">

          <!-- concepto -->

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Concepto *: </label>
            <select class="form-control input-sm" id="concepto" name="concepto">
              <option disabled selected >- -</option>
              @foreach($conceptos as $concepto)
              <option value="{{$concepto}}" {{ (old("concepto") == $concepto ? "selected":"") }}>{{$concepto}}</option>
              @endforeach  
            </select>
          </div>

          <!-- valor -->

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Valor: *: </label>
            <input type="text" class="form-control input-sm" placeholder="$" id="valor" name="valor" value="{{old('valor')}}">
          </div> 

        </div>

        <!-- observaciones-->

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="">Observaciones *: </label>
            <textarea class="form-control input-sm" rows="3" id="observaciones" name="observaciones" placeholder='Escriba sus observaciones' value="{{old('observaciones')}}">{{old('observaciones')}}</textarea>
          </div> 
        </div>



        <!-- Botones -->  
        <div class="form-group">

          <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4"><br>
            <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
          </div>
        </div>  


        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

      </form>








    </div>
  </div>
</div>
<div class="col-md-4 col-sm-4 "></div>

</div>    













<script>
  $(document).ready(function(){



}); //end document ready

</script>



@endsection

@include('templates.main2')