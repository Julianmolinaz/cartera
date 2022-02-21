<div class="info-cliente">
    @permission('consultar_clientes')
        <a 
            href="{{ route('start.clientes.show', $solicitud->cliente_id) }}"
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip" 
            data-placement="top" 
            title="Ver cliente"
        >
            <span class="glyphicon glyphicon-user"></span>
        </a>
    @endpermission
    <h5>Cliente: {{ $cliente->nombre }}</h5> | 
    <span>{{ $cliente->tipo_doc }}: {{ $cliente->num_doc }}</span> |  
    <span>Tel: {{ $cliente->movil }}</span>
</div>