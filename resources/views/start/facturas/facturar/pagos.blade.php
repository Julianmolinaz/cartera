    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Pagos</h3>
      </div>
      <div class="panel-body" style="padding: 20px 18px !important;">

        <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:10px">
          <thead>
            <tr>
              <th>    Id Pago         </th>
              <th>    Id Fact.        </th>
              <th>    # Factura       </th>
              <th>    Fecha           </th>
              <th>    Concepto        </th>
              <th>    Abono           </th>
              <th>    Debe            </th>
              <th>    Estado          </th>
              <th>    Pago Desde      </th>
              <th>    Pago Hasta      </th>
              <th>    Abono Otro Pago </th>
              <th>    Creó            </th>
              <th>    Acción          </th>
            </tr>
          </thead>
          <tbody>
          <?php
            $color_A = "<tr style='background-color:#ffffff;'>";
            $color_B = "<tr style='background-color:#F5F5E0;'>";
            $color   = $color_A;

            for( $i = 0; $i < count($pagos); $i++){  
              
              if( $i > 0 && $pagos[$i]->factura->num_fact != $pagos[$i-1]->factura->num_fact){

                if( $color == $color_A){
                  $color = $color_B;

                }
                else{
                  $color = $color_A;
                }
              }

              echo $color.
                  "<td>{$pagos[$i]->id}</td>
                  <td>{$pagos[$i]->factura->id}</td>
                  <td>{$pagos[$i]->factura->num_fact}</td>
                  <td>{$pagos[$i]->factura->fecha}</td>
                  <td>{$pagos[$i]->concepto}</td>
                  <td align='right'>".number_format($pagos[$i]->abono,0,',','.')."</td>
                  <td align='right'>".number_format($pagos[$i]->debe,0,',','.')."</td>
                  <td>{$pagos[$i]->estado}</td>
                  <td>{$pagos[$i]->pago_desde}</td>
                  <td>{$pagos[$i]->pago_hasta}</td>
                  <td>{$pagos[$i]->abono_pagos_id}</td>
                  <td>".$pagos[$i]->factura->user_create->name." (".$pagos[$i]->created_at.")</td>
                  <td>
                    <button class = 'btn btn-default btn-xs' onclick='show_fact(". $pagos[$i]->factura_id .")'>
                      <span class = 'glyphicon glyphicon-eye-open'  data-toggle='tooltip' data-placement='top' title='Imprimir factura'></span>
                    </button> 

                    <button class = 'btn btn-default btn-xs' onclick='print(". $pagos[$i]->factura_id .")'>
                      <span class = 'glyphicon glyphicon-print'  data-toggle='tooltip' data-placement='top' title='Imprimir factura'></span>
                    </button>  
                  </td>
                  </tr>";

            }
          ?>
          </tbody>
        </table>

      </div>
    </div>
