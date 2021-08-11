@if($precredito->credito)
    <div class="panel panel-default">
        <div class="panel-heading">Pagos</div>
        @include('flash::message')

        <div class="panel-body">
            <div class="table-responsive">
                <table id="datatable" data-order='[[ 0, "desc" ]]' 
                    class="table table-striped table-bordered table-condensed" style="font-size:12px">
                    <thead>
                    <tr>
                        <th>    Id Pago     </th>    
                        <th>    # Recibo    </th>
                        <th>    Fecha       </th>
                        <th>    Concepto    </th>
                        <th>    Abono       </th>
                        <th>    Debe        </th>
                        <th>    Estado      </th>
                        <th>    Desde       </th>
                        <th>    Hasta       </th> 
                        <th>    Descuento   </th>  
                        <th>    Acción      </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                        $color_A = "<tr style='background-color:#ffffff;'>";
                        $color_B = "<tr style='background-color:#D8D8D8;'>";
                        $color_C = "<tr style='background-color:#f2dede;'>";
                        $color = $color_A;
                        $pagos = $precredito->credito->pagos;

                        for( $i = 0; $i < count($pagos); $i++){  

                            $descuento = $pagos[$i]->factura->descuento ? 'Si' : 'No';

                            if ($descuento == 'Si') {
                                $color = $color_C;
                            } else {
                                if( $i > 0 && $pagos[$i]->factura->num_fact != $pagos[$i-1]->factura->num_fact){
                                    if( $color == $color_A){
                                        $color = $color_B;
                                    }
                                    else{
                                        $color = $color_A;
                                    }
                                }
                            }
                        

                            echo $color.
                                "<td>{$pagos[$i]->id}               </td>
                                <td>{$pagos[$i]->factura->num_fact} </td>  
                                <td>{$pagos[$i]->factura->fecha}    </td>
                                <td>{$pagos[$i]->concepto}          </td>
                                <td align='right'>".number_format($pagos[$i]->abono,0,',','.')."</td>
                                <td align='right'>".number_format($pagos[$i]->debe,0,',','.')."</td>
                                <td>{$pagos[$i]->estado}            </td>
                                <td>{$pagos[$i]->pago_desde}        </td>
                                <td>{$pagos[$i]->pago_hasta}        </td>
                                <td>{$descuento}                     </td>
                                <td>
                                
                                <a href=".route('start.facturas.show',$pagos[$i]->factura->id)." 
                                class = 'btn btn-default btn-xs'><span class = 'glyphicon glyphicon-eye-open' 
                                data-toggle='tooltip' data-placement='top' title='Ver'></span></a>                   

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
    </div>
@endif