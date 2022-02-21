<div class="
    card-header 
    {{($data['credito'] && $data['credito']->credito_padre) ? 'card-header--sky' : ''}}"
>
    <div class="card-title">Ventas</div>
    <div class="card-menu">
        @include('start.precreditosV3.show.actions.btn_editar_solicitud')
        @permission('consultar_factura')
        <a 
            href="{{ route('start.facturacion.index', $solicitud->id) }}"
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip"
            data-placement="top"
            title="Facturar"
        >
            <span class="glyphicon glyphicon-flash"></span>
        </a>
        @endpermission
    </div>
</div>
<div class="card-content">
    @foreach($data['ventas'] as $key => $venta)
        <div class="card-content__item" style="background-color: #E5E5E5">
            <div class="card-content__subitem">
                <div class="card-content__subitem-title">
                    Producto {{ $key + 1 }}
                </div>
            </div>
            <div class="card-content__subitem">
                <div class="card-content__subitem-title"></div>
                <div style="font-weight: 700">{{ $venta['producto']['nombre'] }}</div>
            </div>
            <div class="card-content__subitem">
                <div class="card-content__subitem-title"></div>
                <div style="font-weight: 700">
                    {{ $venta['valor'] ? "$ " . decimal($venta['valor']) : "" }}
                    @permission('editar_valor_producto')
                    <a
                        href="javascript:void(0);"
                        onclick="editValorProducto(
                            {{ json_encode($venta['valor']) }},
                            {{ $venta['id'] }},
                            {{ $solicitud->id }},
                            {{ $key + 1 }}
                        )"
                    >edit</a>
                    @endpermission
                </div>
            </div>

        </div>
        
        @if($venta['producto']['con_vehiculo'] && $venta['vehiculo'])
           @include('start.precreditosV3.show.ventas.vehiculo')
        @endif  

        @if($venta['producto']['con_invoice'])
           @include('start.precreditosV3.show.ventas.invoice')
        @endif
        
    @endforeach
</div>

@include('start.precreditosV3.show.actions.edit_vehiculo')
@include('start.precreditosV3.show.actions.edit_valor_producto')