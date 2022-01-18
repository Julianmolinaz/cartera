<div class="card-header">
    <div class="card-title">Productos</div>
    <div class="card-menu">
        <a 
            href="#"
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip"
            data-placement="top"
            title="Editar productos"
        >
            <span class="glyphicon glyphicon-pencil"></span>
        </a>
        <a 
            href="#"
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip"
            data-placement="top"
            title="Facturar"
        >
            <i class="fa fa-barcode" aria-hidden="true"></i>
        </span>
        </a>
    </div>
</div>
<div class="card-content">
    @foreach($data['ventas'] as $key => $venta)
        <div class="card-content__item" style="background-color: #E5E5E5">
            <div class="card-content__subitem">
                <div class="card-content__subitem-title">Producto {{ $key + 1 }}</div>
            </div>
            <div class="card-content__subitem">
                <div class="card-content__subitem-title"></div>
                <div style="font-weight: 700">{{ $venta['producto']['nombre'] }}</div>
            </div>
        </div>
        @if($venta['producto']['con_vehiculo'])
            <div class="card-content__item">
                <div class="card-content__subitem">
                    <div class="card-content__subitem-title">Placa</div>
                    <div>{{ $venta['vehiculo']['placa'] }}</div>
                </div>
                <div class="card-content__subitem">
                    <div class="card-content__subitem-title">Tipo vehículo</div>
                    <div>{{ $venta['vehiculo']['tipo_vehiculo'] }}</div>
                </div>
                <div class="card-content__subitem">
                    <div class="card-content__subitem-title">Modelo</div>
                    <div>{{ $venta['vehiculo']['modelo'] }}</div>
                </div>
            </div>        
            <div class="card-content__item">
                <div class="card-content__subitem">
                    <div class="card-content__subitem-title">
                        Cilindraje
                    </div>
                    <div>{{ $venta['vehiculo']['cilindraje'] }}</div>
                </div>
                <div class="card-content__subitem">
                    <div class="card-content__subitem-title">Vence SOAT</div>
                    <div>{{ ddmmyyyy($venta['vehiculo']['vencimiento_soat']) }}</div>
                </div>
                <div class="card-content__subitem">
                    <div class="card-content__subitem-title">Vence RTM</div>
                    <div>{{ ddmmyyyy($venta['vehiculo']['vencimiento_rtm']) }}</div>
                </div>
            </div>
        @endif  
        @if($venta['producto']['con_invoice'])
            <div style="background-color: #eeecf33b;">
                <div class="card-content__item">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Factura</div>
                        <div style="font-weight: 700">#45343</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Estado</div>
                        <div>En proceso</div>
                    </div>
                </div>
                <div class="card-content__item">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Fecha de expedición</div>
                        <div>01-01-2022</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Costo</div>
                        <div>$600.000,oo</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">IVA</div>
                        <div>$23.000,oo</div>
                    </div>
                </div>
                <div class="card-content__item">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Otros</div>
                        <div>$10.000,oo</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Expedido a</div>
                        <div>Cliente</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Proveedor</div>
                        <div>CDA del Norte</div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>