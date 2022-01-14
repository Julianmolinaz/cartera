@extends('templates.main2')

@section('title', 'ver solicitud')

@section('contenido')
    <style>
        .obligacion-container {
            padding: 0px 30px;
            display: grid;
            grid-template-areas: "productos solicitud credito";
            grid-template-columns: 350px 400px 350px;
            gap: 20px;
            margin-right: auto;
            margin-left: auto;
        }
        .card-productos, .card-solicitud, .card-credito
        {
            background-color: #ffffff;
            padding-bottom: 30px;
        }
        .card-productos {
            min-width: 300px;
            grid-area: productos;
        }
        .card-header {
            display: flex;
            flex-direction: column;
            gap: 4px;
            background-color: #313030;
            border-radius: 4px 4px 0 0;
            padding: 10px;
        }
        .card-title {
            font-size: 16px;
            color: #ffffff;
            font-weight: 400;
        }
        .card-solicitud {
            grid-area: solicitud;
            min-width: 300px;
        }
        .card-credito {
            grid-area: credito;
        }
        .my-btn {
            border: none;
        }
        .card-content {
            height: 500px;
            overflow: scroll;
            overflow-x: hidden;
        }
        .card-content::-webkit-scrollbar { 
            scrollbar-width: none;
            display: none; 
        }
        .card-content__item {
            display: flex;
            gap: 7px;
            padding: 10px;
        }
        .card-content__item:not(:last-child) {
            border-bottom: 1px solid #E5E5E5;
        }
        .card-content__subitem {
            width: 33.3%;
        }
        .card-content__subitem-title {
            font-weight: 600;
        }
        .card-content__subitem-line {
            width: 100%;
            display: grid;
            grid-template-columns: 50% 50%;
        }
        .pg-tag {
            font-size: 12px;
            padding: 3px 20px;
            color: #fff;
            font-weight: 600;
            border-radius: 4px;
        }
        .pg-tag--primary {
            background-color: #0982ed;
        }
        .pg-tag--flow {
            background-color: #ffc300;
        }
    </style>

    <div class="obligacion-container">
        <div class="card-productos">
            <div class="card-header">
                <div class="card-title">Productos</div>
                <div class="card-menu">
                    <a href="#" class='btn btn-default btn-xs my-btn'>
                        <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Ver solicitud">                            
                        </span>
                    </a>
                    <a href="#" class='btn btn-default btn-xs my-btn'>
                        <span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Ver solicitud">                            
                        </span>
                    </a>
                    <a href="#" class='btn btn-default btn-xs my-btn'>
                        <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Ver solicitud">                            
                        </span>
                    </a>
                </div>
            </div>
            <div class="card-content">
                <div class="card-content__item" style="background-color: #E5E5E5">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Producto 1</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title"></div>
                        <div style="font-weight: 700">SOAT</div>
                    </div>
                </div>
                <div class="card-content__item">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Placa</div>
                        <div>DKZ62E</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Tipo vehículo</div>
                        <div>Moto</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Modelo</div>
                        <div>2016</div>
                    </div>
                </div>                
                <div class="card-content__item">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Cilindraje</div>
                        <div>150</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Vence SOAT</div>
                        <div>01-01-2022</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Vence RTM</div>
                        <div>01-01-2022</div>
                    </div>
                </div>
                <div style="background-color: #eeecf33b;">
                    <div class="card-content__item">
                        <div class="card-content__subitem">
                            <div class="card-content__subitem-title">Factura</div>
                        </div>
                        <div class="card-content__subitem">
                            <div class="card-content__subitem-title"></div>
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
                <div class="card-content__item" style="background-color: #E5E5E5">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Producto 2</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title"></div>
                        <div style="font-weight: 700">RTM</div>
                    </div>
                </div>
                <div class="card-content__item">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Placa</div>
                        <div>DKZ62E</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Tipo vehículo</div>
                        <div>Moto</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Modelo</div>
                        <div>2016</div>
                    </div>
                </div>                
                <div class="card-content__item">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Cilindraje</div>
                        <div>150</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Vence SOAT</div>
                        <div>01-01-2022</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Vence RTM</div>
                        <div>01-01-2022</div>
                    </div>
                </div>
                <div class="card-content__item" style="background-color: #eeecf33b">
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title">Factura</div>
                    </div>
                    <div class="card-content__subitem">
                        <div class="card-content__subitem-title"></div>
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
                <div class="card-content__item" style="background-color: #E5E5E5">
                        <div class="card-content__subitem">
                            <div class="card-content__subitem-title">Producto 3</div>
                        </div>
                        <div class="card-content__subitem">
                            <div class="card-content__subitem-title"></div>
                            <div style="font-weight: 700">CASCO</div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="card-solicitud">
            @include('start.precreditosV3.show.solicitud')
        </div>
        <div class="card-credito">
            @include('start.precreditosV3.show.credito')
        </div>
    </div>

@endsection
