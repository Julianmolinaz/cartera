        <div class="panel panel-warning">
          <!-- Default panel contents -->
          <div class="panel-heading" style="background-color: #FFC300;color:black;">
            <h4><i class="fas fa-shopping-cart"></i> Listado de pagos </h4>
          </div>
          <div class="panel-body" style="padding:5px;">
            <table id="tabla" class="table table-striped" >
                  <thead>
                    <tr>
                      <th>  Cant        </th>
                      <th>  Concepto    </th>
                      <th>  Pago desde  </th>
                      <th>  Pago hasta  </th>
                      <th>  Subtotal    </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="pago in general.pagos">
                       <td>@{{ pago.cant }}     </td>
                       <td>@{{ pago.concepto }} </td>
                       <td>@{{ pago.ini  }}     </td>
                       <td>@{{ pago.fin }}      </td>
                       <td>@{{ pago.subtotal }} </td>
                    </tr>
                 </tbody>
              </table>

               <!-- BOTON ACEPTAR -->
               <center>
                <div class="col-md-12 col-sm-12 col-xs-12"><br>

                {!! link_to('start/pagos/inicio',$title='Salir',$attributes =  ['id'=>'salir','class'=>'btn btn-warning '],$secure = null) !!}
                <a href="#" class="btn btn-danger" @click="borrar">Borrar</a>
                <a href="#" class="btn btn-primary" @click="aceptar">Aceptar</a>
              
                </div>
               </center>

          </div>

        </div>