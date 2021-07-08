@include('flash::message')

@section('title','fac_proveedor')

@section('contenido')

<div class="panel panel-primary">

    <div class="panel-heading">Reporte Factura Proveedor [ {{ $rango->ini->toDateString().' - '.$rango->end->toDateString()}} ]
        <button id="btn_exc_prov" class="btn btn-warning"><b>Exportar</b></button>
    </div>
</div>

<div>
    <table id="datatable" class="table table-bordered" style="font-size:12px">
        <thead>
            <tr>
                <th>  Solicitud       </th>
                <th>  Crédito         </th>
                <th>  Centro costos   </th>
                <th>  Cuota_inicial   </th>
                <th>  Num factura     </th>
                <th>  Producto        </th>
                <th>  Fecha exp       </th>
                <th>  Costo           </th>
                <th>  Iva             </th>
                <th>  Otros           </th>
                <th>  Expedido_a      </th>
                <th>  Proveedor       </th>
                <th>  Doc proveedor   </th>
                <th>  Placa           </th>
                <th>  Nombre_cliente  </th>
                <th>  Doc cliente     </th>
                <th>  Ejecutivo       </th>
                <th>  observaciones   </th>
                <th>  Fecha_solicitud </th>
                <th>  Valor crédito   </th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                <td>    {{$factura->solicitud}}      </td>
                <td>    {{$factura->credito}}        </td>
                <td>    {{$factura->centro_costos}}        </td>
                <td>    {{$factura->cuota_inicial}}  </td>
                <td>    {{$factura->num_fact}}       </td>
                <td>    {{$factura->producto}}       </td>
                <td>    {{$factura->fecha_exp}}      </td>
                <td>    {{$factura->costo}}          </td>
                <td>    {{$factura->iva}}            </td>
                <td>    {{$factura->otros}}          </td>
                <td>    {{$factura->expedido_a}}     </td>
                <td>    {{$factura->proveedor}}   </td>
                <td>    {{$factura->doc_proveedor}}            </td>
                <td>    {{$factura->placa}}          </td>
                <td>    {{$factura->nombre}}         </td>
                <td>    {{$factura->num_doc}}        </td>
                <td>    {{$factura->name}}           </td>
                <td>    {{$factura->observaciones}}  </td>
                <td>    {{$factura->created_at}}     </td>
                <td>    {{$factura->valor_credito}}  </td>
            
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
        "searching": false

    });

    });


    $('#btn_exc_prov').click(function(){
        $('#datatable').table2excel({
            name: 'Reporte',
            filename: "{{'factura_proveedor'.$rango->ini->toDateString().'-a-'.$rango->end->toDateString().'.xls'}}"
        });
    });

</script>

@endsection

@include('templates.main2')


















