        <div class="panel panel-warning">
          <!-- Default panel contents -->
          <div class="panel-heading" style="background-color: #FFC300;color:black;">
            <h3 class="panel-title"><i class="fas fa-shopping-cart"></i> Pagos generados</h3>
          </div>
          <div class="panel-body" style="padding:5px;">

            <div class="alert alert-danger" role="alert" v-if="message2">@{{ message2 }}</div>  

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
                    <tr v-for="(pago, index) in general.pagos" style="font-size: 10px;"
                        :class="{ danger : pago.marcado  }">
                       <td class="td-small">@{{ pago.cant }}     </td>
                       <td class="td-small">@{{ pago.concepto }} </td>
                       <td class="td-small">@{{ pago.ini  }}     </td>
                       <td class="td-small">@{{ pago.fin }}      </td>
                       <td class="td-small">@{{ pago.subtotal }} </td>
                    </tr>
                 </tbody>
              </table>

               <!-- BOTON ACEPTAR -->
               <center>
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">

                {!! link_to('start/pagos/inicio',$title='Salir',$attributes =  ['id'=>'salir','class'=>'btn btn-warning '],$secure = null) !!}
                <a href="#" class="btn btn-danger" @click="borrar">Borrar</a>
                <a href="#" class="btn btn-primary" @click="aceptar">Aceptar</a>
              
                </div>
               </center>

          </div>

        </div>