        <div class="panel panel-primary" >
          <div class="panel-heading">
            <h3 class="panel-title"><i class="far fa-edit"></i> Generador de pagos</h3>
          </div>
          <div class="panel-body">

            <div class="alert alert-success" role="alert" v-if="message">@{{ message }}</div>            

            <!--formulario con los campos necesarios para crear pagos y agregarlos a una tabla-->
    
            <form class="form-horizontal form-label-left" action="" method="POST">

              <div class="form-group">
               <!-- num_factura *****-->
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <label># Factura:</label>
                  <input class="form-control input-small" type="text" id="num_factura" placeholder="#" 
                    v-model="general.num_fact" :readonly="general.auto">
                </div>

                 <!-- fecha_factura *****-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                      <label>Fecha:</label>
                        <input type="date" class="form-control input-small" id="fecha_factura" 
                            v-model="general.fecha" :readonly="general.auto">
                      </div>

               <!-- monto *****-->
                <div class="col-md-3 col-sm-3 col-xs-12" id="div_monto">
                  <label for="">Monto:</label>
                  <input type="number" class="form-control input-small" placeholder="$" 
                    name="monto" id="monto" v-model="general.monto">
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                  <label for="">Tipo de Pago</label>
                  <select class="form-control input-small" id="tipo" v-model="general.tipo_pago"
                    v-on:change="set_banco">
                    <option value="" readonly selected hidden="">- -</option>
                    @foreach($tipo_pago as $tipo)
                      <option value="{{$tipo}}">{{$tipo}}</option>
                    @endforeach
                  </select>
                </div>

              </div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6" id="btn_auto" v-if="punto_auto">
                    <a href="#" class="btn btn-default btn-block btn-small" id="general.auto" @click="set_auto()">
                      Consecutivo Auto
                    </a>
                  </div>

                  <!-- BOTON AGREGAR -->
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="#" class="btn btn-primary btn-block btn-small" @click="agregar">Agregar</a>
                  </div>
                </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
                <!--Fin del formulario creador de pagos-->
    
          @include('start.facturas.facturar.banco_modal')
          </div><!--fin del panel-body-->
        </div><!-- fin de panel panel-default-->
