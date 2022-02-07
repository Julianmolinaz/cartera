<div class="panel panel-success">
    <div class="panel-heading">Pagos por solicitudes</div>
    @include('flash::message')

    <div class="panel-body" id="element">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="font-size:12px">
                <thead>
                <tr>
                    <th>    # Fact   </th>    
                    <th>    Pago id  </th>
                    <th>    Fecha    </th>
                    <th>    Concepto </th>
                    <th>    Funcionario </th>
                    <th>    Sistema   </th>
                    <th>    Acción   </th>
                </tr>
                </thead>
                <tbody>
                @foreach($precredito->pagos as $pago)
                    <tr>
                    <td>{{ $pago->factura->num_fact }}</td>
                    <td>{{ $pago->id }}</td>
                    <td>{{ $pago->factura->fecha }}</td>
                    <td>{{ $pago->concepto->nombre }}</td>
                    <td>{{ $pago->user_create->name }}</td>
                    <td>{{ $pago->created_at }}</td>
                    <td>
                        <a href="{{ route('start.precred_pagos.show', $pago->factura->id) }}"
                        class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                        <a href="javascript:void(0);" class='btn btn-default btn-xs' onclick="print('{{$pago->factura->id}}')">
                                <span class = "glyphicon glyphicon-print" title="Imprimir"></span>
                            </a>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>  

</div>