@if(
    ($solicitud->aprobado !== 'Si' && $user->can('editar_solicitud')) ||
    $user->can('editar_creditos')
)
    <a 
        href="{{ route('start.precreditosV3.edit', $solicitud->id) }}"
        class='btn btn-default btn-xs my-btn'
        data-toggle="tooltip" 
        data-placement="top" 
        title="Editar solicitud"
    >
        <span class="glyphicon glyphicon-pencil"></span>
    </a>
@endif