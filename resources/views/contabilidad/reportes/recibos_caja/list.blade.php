@include('flash::message')

@section('title','Recibos de Caja')

@section('contenido')

<div class="panel panel-primary">

    <div class="panel-heading">Reporte Recibos de Caja [ {{ $rango->ini->toDateString().' - '.$rango->end->toDateString()}} ]
        <button id="btn_exc_recibos" class="btn btn-warning"><b>Exportar</b></button>
    </div>
</div>

<div>
    <table id="datatable" class="table table-bordered" style="font-size:12px">
        <thead>
            <tr>
                <th>    Tipo de comprobante                 </th>
                <th>    Consecutivo comprobante             </th>
                <th>    Fecha de elaboración                </th>
                <th>    Sigla moneda                        </th>
                <th>    Tasa de cambio                      </th>
                <th>    Código cuenta contable              </th>
                <th>    Identificación tercero              </th>
                <th>    Sucursal                            </th>
                <th>    Código producto                     </th>
                <th>    Código de bodega                    </th>
                <th>    Acción                              </th>
                <th>    Cantidad producto                   </th>
                <th>    Prefijo                             </th>
                <th>    Consecutivo                         </th>
                <th>    No. cuota                           </th>
                <th>    Fecha vencimiento                   </th>
                <th>    Código impuesto                     </th>
                <th>    Código grupo activo fijo            </th>
                <th>    Código activo fijo                  </th>
                <th>    Descripción                         </th>
                <th>    Código centro/subcentro de costos   </th>
                <th>    Débito                              </th>
                <th>    Crédito                             </th>
                <th>    Observaciones                       </th>
                <th>    Base gravable libro ventas          </th>
                <th>    Base exenta libro ventas            </th>
                <th>    Mes de cierre                       </th>
                <th>    Tipo                                </th>
                <th>    Banco                               </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>    {{ $item['tipo_comp']}}           </td>
                <td>    {{ $item['cons_comp']}}           </td>
                <td>    {{ $item['fecha_elab']}}          </td>
                <td>    {{ $item['sigla_moneda']}}        </td>
                <td>    {{ $item['tasa_cambio']}}         </td>
                <td>    {{ $item['cod_cuenta']}}          </td>
                <td>    {{ $item['iden_tercero']}}        </td>
                <td>    {{ $item['sucursal']}}            </td>
                <td>    {{ $item['cod_prod']}}            </td>
                <td>    {{ $item['cod_bodega']}}          </td>
                <td>    {{ $item['accion']}}              </td>
                <td>    {{ $item['cant_prod']}}           </td>
                <td>    {{ $item['prefijo']}}             </td>
                <td>    {{ $item['consec']}}              </td>
                <td>    {{ $item['no_cuota']}}            </td>
                <td>    {{ $item['fecha_venc']}}          </td>
                <td>    {{ $item['cod_impuesto']}}        </td>
                <td>    {{ $item['cod_grupo_act_fijo']}}  </td>
                <td>    {{ $item['cod_act_fijo']}}        </td>
                <td>    {{ $item['descripcion']}}         </td>
                <td>    {{ $item['cod_cc']}}              </td>
                <td>    {{ $item['debito']}}              </td>
                <td>    {{ $item['credito']}}             </td>
                <td>    {{ $item['obs']}}                 </td>
                <td>    {{ $item['base_grab_lib_comp']}}  </td>
                <td>    {{ $item['base_exen_lib_comp']}}  </td>
                <td>    {{ $item['mes_cierre']}}          </td>
                <td>    {{ $item['tipo']}}                </td>
                <td>    {{ $item['banco']}}               </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>

<script>
    $( document ).ready(function() {

    $('#datatable').dataTable( {
        'paging':false,
        'ordering':true,
        'scrollY': 400,
        "scrollCollapse": true,
        "scrollX": true,
        "searching": true

    });

    });


    $('#btn_exc_recibos').click(function(){
        $('#datatable').table2excel({
            name: 'Reporte',
            filename: "{{'recibos_caja'.$rango->ini->toDateString().'-a-'.$rango->end->toDateString().'.xls'}}"
        });
    });

</script>

@endsection

@include('templates.main2')


















