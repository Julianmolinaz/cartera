<!--panel generador de pagos-->
<!--**********************************************************************-->
<div class="panel panel-primary" >
  <div class="panel-heading">
    <h3 class="panel-title">Generador de pagos</h3>
  </div>
  <div class="panel-body">

    <!--formulario con los campos necesarios para crear pagos y agregarlos a una tabla-->

    <form class="form-horizontal form-label-left" @click.prevent="submitForm">

      <div class="form-group">
       <!-- num_factura *****-->
        <div class="col-md-2 col-sm-2 col-xs-12">
          <label># Factura:</label>
          <input class="form-control input-sm" type="number" id="num_factura" placeholder="#">
        </div>

         <!-- fecha_factura *****-->
        <div class="col-md-3 col-sm-3 col-xs-12">
              <label>Fecha:</label>
                <input type="date" class="form-control input-sm" id="fecha_factura">
              </div>

       <!-- monto *****-->
        <div class="col-md-2 col-sm-2 col-xs-12" id="div_monto">
          <label for="">Monto:</label>
          <input type="number" class="form-control input-sm" placeholder="$" name="monto" id="monto">
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label for="">Tipo de Pago</label>
          <select class="form-control input-sm" id="tipo">
            <option value="" readonly selected hidden="">- -</option>
            @foreach($tipo_pago as $tipo)
              <option value="{{$tipo}}">{{$tipo}}</option>
            @endforeach
          </select>
        </div>

        <!-- BOTON AGREGAR -->
        <div class="col-md-2 col-sm-2 col-xs-12"><br/>
          <button  class="btn btn-primary" v-on:click="agregar">Agregar</button>

        </div>
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>

    <!--Fin del formulario creador de pagos-->

  </div><!--fin del panel-body-->
</div><!-- fin de panel panel-default-->
<!--end panel generador de pagos-->