@include('flash::message')

@section('title','fac_venta')

@section('contenido')

<div class="panel panel-primary">

    <div class="panel-heading">Reporte Facturas Venta [ {{ $rango->ini->toDateString().' - '.$rango->end->toDateString()}} ]
        <button id="btn_exc_venta" class="btn btn-warning"><b>Exportar</b></button>
    </div>
</div>

<div>
    <table id="datatable" class="table table-bordered" style="font-size:12px">
        <thead>
            <tr>
                <th>    222                                 </th>
                <th>    Consecutivo                         </th>
                <th>    Identificación tercero              </th>
                <th>    Sucursal                            </th>
                <th>    Código centro/subcentro de costos   </th>
                <th>    Fecha de elaboración                </th>
                <th>    Sigla moneda                        </th>
                <th>    Tasa de cambio                      </th>
                <th>    Nombre contacto                     </th>
                <th>    Email Contacto                      </th>
                <th>    Orden de compra                     </th>
                <th>    Orden de entrega                    </th>
                <th>    Fecha orden de entrega              </th>
                <th>    Código producto                     </th>
                <th>    Descripción producto                </th>
                <th>    Identificación vendedor             </th>
                <th>    Código de bodega                    </th>
                <th>    Cantidad producto                   </th>
                <th>    Valor unitario                      </th>
                <th>    Valor Descuento                     </th>
                <th>    Base AIU                            </th>
                <th>    Código impuesto cargo               </th>
                <th>    Código impuesto cargo dos           </th>
                <th>    Código impuesto retención           </th>
                <th>    Código ReteICA                      </th>
                <th>    Código ReteIVA                      </th>
                <th>    Código forma de pago                </th>
                <th>    Valor Forma de Pago                 </th>
                <th>    Fecha Vencimiento                   </th>
                <th>    Observaciones                       </th>
                <th>    solicitud                           </th>
                <th>    novedad                             </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>    {{ $item['222'] }}   </td>
                <td>    {{ $item['consecu'] }}   </td>
                <td>    {{ $item['iden_tercero'] }}   </td>
                <td>    {{ $item['sucursal'] }}   </td>
                <td>    {{ $item['cod_cc'] }}   </td>
                <td>    {{ $item['fecha_elab'] }}   </td>
                <td>    {{ $item['sigla_moneda'] }}   </td>
                <td>    {{ $item['tasa_cambio'] }}   </td>
                <td>    {{ $item['nom_contac'] }}   </td>
                <td>    {{ $item['email_contac'] }}   </td>
                <td>    {{ $item['ord_compra'] }}   </td>
                <td>    {{ $item['ord_entrega'] }}   </td>
                <td>    {{ $item['fecha_ord_entrega'] }}   </td>
                <td>    {{ $item['cod_prod'] }}   </td>
                <td>    {{ $item['desc_prod'] }}   </td>
                <td>    {{ $item['ident_vende'] }}   </td>
                <td>    {{ $item['cod_bodega'] }}   </td>
                <td>    {{ $item['cant_prod'] }}   </td>
                <td>    {{ $item['vlr_und'] }}   </td>
                <td>    {{ $item['vlr_desc'] }}   </td>
                <td>    {{ $item['base_aui'] }}   </td>
                <td>    {{ $item['cod_cargo'] }}   </td>
                <td>    {{ $item['cod_cargo_dos'] }}   </td>
                <td>    {{ $item['cod_rete'] }}   </td>
                <td>    {{ $item['cod_rete_ica'] }}   </td>
                <td>    {{ $item['cod_rete_iva'] }}   </td>
                <td>    {{ $item['cod_form_pago'] }}   </td>
                <td>    {{ $item['vlr_form_pago'] }}   </td>
                <td>    {{ $item['fecha_venc'] }}   </td>
                <td>    {{ $item['obs'] }}   </td>
                <td>    {{ $item['solicitud'] }}   </td>
                <td>    {{ $item['novedad'] }}   </td>
            
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
        //"scrollX": true,
        //"searching": false

    });

    });


    $('#btn_exc_venta').click(function(){
        $('#datatable').table2excel({
            name: 'Reporte',
            filename: "{{'facturas_venta'.$rango->ini->toDateString().'-a-'.$rango->end->toDateString().'.xls'}}"
        });
    });

</script>

@endsection

@include('templates.main2')