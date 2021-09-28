@section('title','Crear Solicitud')

@section('contenido')

<div class="row">

<div class="col-md-2 col-sm-2"></div>

  <div class="col-md-8 col-sm-8 col-xs-12">

  <div class="panel panel-primary">
    <div class="panel-heading">Crear Solicitud de Crédito <small>{{$cliente->nombre.' '.$cliente->num_doc}}</small></div>
    <div class="panel-body">
        @include('templates.error')
        <br />

        <form class="form-horizontal form-label-left" action="{{route('start.precreditos.store')}}" method="POST">

        <input type="hidden" name="cliente_id" value="{{$cliente->id}}">
          <!-- NOMBRE**************************************************************************-->
          <div class="form-group">

            <div class="col-md-4 col-sm-4 col-xs-12">
              <label for="">Número de Factura *:</label>
              <input type="text" class="form-control" placeholder="ingrese número de factura" id="num_fact" name="num_fact"  value="{{old('num_fact')}}" autofocus>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <label for="">Fecha de afiliación:</label>
                <input type="text" class="form-control" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha" name="fecha" value="{{old('fecha')}}">
            </div>

          </div>

            <!-- NUM DOC **************************************************************************-->
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Costo del crédito *: </label>
              <input type="text" class="form-control" placeholder="ingrese monto solicitado" id="vlr_fin" name="vlr_fin" value="{{old('vlr_fin')}}" >
            </div>
          </div>


          <div class="form-group">  

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Periodo *: </label>
              <select class="form-control" placeholder="periodo" name="periodo" id="periodo" >
                <option value="" readonly selected hidden="periodo">- -</option>
                  @foreach(['Quincenal','Mensual'] as $key => $tipo)
                    <option id="periodo" name="periodo" value="{{ $tipo }}" {{ (old("periodo") == $tipo ? "selected":"") }}>{{  $tipo }}</option>
                  @endforeach
              </select>
            </div>

           <div class="col-md-3 col-sm-3 col-xs-12">
            <label># Meses *:</label>
              <input type="number" class="form-control" id="meses" name="meses"  autocomplete="off" placeholder="Meses" min="" max="" step="1" value="{{old('meses')}}">
            </div>


           <div class="col-md-6 col-sm-6 col-xs-12">
            <label># Cuotas *:</label>
              <input type="number" class="form-control" id="cuotas" name="cuotas"  autocomplete="off" placeholder="cuotas" readonly value="{{old('cuotas')}}">
            </div>
 
          </div>

          <div class="form-group">  
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label>Observaciones</label>
              <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder='Escriba la descripción de la modalidad' autocomplete="on"  value="{{old('observaciones')}}"></textarea>
            </div>
              
          </div>

         <!-- BOTONES **************************************************************************-->
         <div class="form-group">
         
          <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3"><br>

            <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>

            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
          </div>

        </div>


        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      </form>
      <!-- END FORMULARIO ******-->


    </div>
  </div>

</div>

<div class="col-md-2 col-sm-2"></div>

</div>





@endsection
@include('templates.main2')