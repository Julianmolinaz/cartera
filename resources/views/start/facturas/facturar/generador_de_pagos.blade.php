        <div class="panel panel-primary" >
          <div class="panel-heading">
            <h3 class="panel-title"><i class="far fa-edit"></i> Generador de pagos</h3>
          </div>
          <div class="panel-body">

            <!--formulario con los campos necesarios para crear pagos y agregarlos a una tabla-->
            <br>

            <form class="form-horizontal form-label-left" action="" method="POST">

              <div class="form-group">
               <!-- num_factura *****-->
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <label># Factura:</label>
                  <input class="form-control input-sm" type="number" id="num_factura" placeholder="#">
                </div>

                 <!-- fecha_factura *****-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                      <label>Fecha:</label>
                        <input type="date" class="form-control input-sm" id="fecha_factura">
                      </div>

               <!-- monto *****-->
                <div class="col-md-3 col-sm-3 col-xs-12" id="div_monto">
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

              </div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6" id='btn_auto'>
                    <a href="#" class="btn btn-default btn-block" id="auto">Consecutivo Auto</a>
                  </div>

                  <!-- BOTON AGREGAR -->
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! link_to('#',$title='Agregar',$attributes =  ['id'=>'agregar','class'=>'btn btn-primary btn-block'],$secure = null) !!}
                  </div>
                </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
          <br>
            <!--Fin del formulario creador de pagos-->

          </div><!--fin del panel-body-->
        </div><!-- fin de panel panel-default-->
