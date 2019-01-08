<script>
  Vue.component('generador-component',{
    template: `
        <div class="panel panel-primary" >
          <div class="panel-heading">
            <h3 class="panel-title"><i class="far fa-edit"></i> Generador de pagos</h3>
          </div>
          <div class="panel-body">

            <div class="alert alert-success" role="alert">Prueba</div>            

            <!--formulario con los campos necesarios para crear pagos y agregarlos a una tabla-->
    
            <form class="form-horizontal form-label-left" action="" method="POST">

              <div class="form-group">
               <!-- num_factura *****-->
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <label># Factura:</label>
                  <input class="form-control input-small" type="number" id="num_factura" placeholder="#" >
                </div>

                 <!-- fecha_factura *****-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <label>Fecha:</label>
                    <input type="date" class="form-control input-small" id="fecha_factura">
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label for="">Tipo de Pago</label>
                  <select class="form-control input-small" id="tipo" v-model="factura.tipo_pago">
                    <option value="" readonly selected hidden="">- -</option>
                    <option v-for="tipo in tipo_pago">@{{ tipo }}</option>

                  </select>
                </div>
              </div>  

              <div class="form-group">
               <!-- concepto del pago *****-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>Concepto</label>
                  <select class="form-control input-small">
                    <option readonly selected>- -</option>
                    <option v-for="concepto in conceptos" :value="concepto.id">@{{ concepto.nombre }}</option>
                  </select>
                </div>

               <!-- monto *****-->
                <div class="col-md-6 col-sm-6 col-xs-12" id="div_monto">
                  <label for="">Monto:</label>
                  <input type="number" class="form-control input-small" placeholder="$" name="monto" id="monto">
                </div>

              </div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6" id="btn_auto">
                    <a href="#" class="btn btn-default btn-block btn-small">
                      Consecutivo Auto
                    </a>
                  </div>

                  <!-- BOTON AGREGAR -->
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="#" class="btn btn-primary btn-block btn-small">Agregar</a>
                  </div>
                </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
                <!--Fin del formulario creador de pagos-->
                @{{$data}}

          </div><!--fin del panel-body-->
        </div><!-- fin de panel panel-default-->
    `,
    data(){
      return {
        tipo_pago : {!! json_encode($tipo_pago) !!},
        punto     : {!! json_encode($punto) !!},
        factura:{
          precredito: {!! json_encode($precredito) !!},
          num_fact  : '',
          tipo_pago : 'Efectivo',
          total     : 0,
          fecha     : '',
          pagos     : {
            subtotal : 0,
            concepto : '',
          }
        }
      }
    } 
  });

</script>      

        