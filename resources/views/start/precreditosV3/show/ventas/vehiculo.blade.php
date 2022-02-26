<div class="card-content__item">
    <div class="card-content__subitem">
        <div class="card-content__subitem-title">Placa</div>
        <div>
            {{ $venta['vehiculo']['placa'] }}
            @permission('editar_vehiculo')
                <a
                    href="javascript:void(0);"
                    onclick="editVehiculo(
                        {{ json_encode($venta['vehiculo']) }},
                        {{ $solicitud->id }},
                        {{ $key +  1 }}
                    )"
                >edit</a>
            @endpermission
        </div>
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
