@include('start.precreditosV3.show.actions.btn_editar_solicitud')
@permission('hacer_pago')
<a 	href="{{route('start.facturas.create',$credito->id)}}" 
    class='btn btn-default btn-xs my-btn'
    data-toggle="tooltip" 
    data-placement="top" 
    title="Hacer Pago"
>
    <span class="glyphicon glyphicon-usd"></span>
</a>
@endpermission
@permission('gestionar_sanciones')
<a 
    href="{{route('admin.sanciones.show',$creditoId)}}" 
    class='btn btn-default btn-xs my-btn' 
    data-toggle="tooltip" 
    data-placement="top" 
    title="Sanciones diarias"
>
    <span class="glyphicon glyphicon-record"></span>
</a>
@endpermission
@permission('consultar_multas')
<a  
    href="{{route('admin.multas.show',$creditoId)}}" 
    class='btn btn-default btn-xs my-btn' 
    data-toggle="tooltip" 
    data-placement="top" 
    title="Multas prejuridicas y juridicas"
>
    <span class="glyphicon glyphicon-hourglass"></span>
</a>
@endpermission
@permission('refinanciar_creditos')
<a
    href="{{route('start.refinanciacionV3.create',$creditoId)}}"
    class="btn btn-default btn-xs my-btn"
    data-toggle="tooltip" 
    data-placement="top" 
    title="Refinanciar crédito"
>
    <i class="fa fa-reply-all" aria-hidden="true"></i>
</a>
@endpermission
<a
    href="javascript:void(0);"
    onclick="showAcuerdo()"
    class="btn btn-default btn-xs my-btn"
    data-toggle="tooltip" 
    data-placement="top" 
    title="Acuerdos de pago"
>
    <span class="glyphicon glyphicon-calendar"></span>
</a>
@permission('registro_llamada')
<a 
    href="{{route('call.index_unique',$creditoId)}}"
    class='btn btn-default btn-xs my-btn'
    data-toggle="tooltip" 
    data-placement="top" 
    title="Call Center"
>
    <span class = "glyphicon glyphicon-phone-alt"></span>
</a>
@endpermission
<a 
    href="javascript:void(0);"
    onclick="showModalCertificados()"
    class='btn btn-default btn-xs my-btn'  
    data-toggle="tooltip" 
    data-placement="top" 
    title="Certificados"
>
    <span class = "glyphicon glyphicon-file">
</a>
<a 
    href="{{route('admin.get_estado_cuenta',$data['credito']->id)}}"
    class='btn btn-default btn-xs my-btn'
    data-toggle="tooltip" 
    data-placement="top" 
    title="Estado de cuenta"
>
    <span><i class="fab fa-laravel"></i></span>
</a>
@permission('ver_seguimiento_proceso_prejuridico')
<a 
    href="{{ route('admin.anotaciones.index', $credito->id) }}"
    data-toggle="tooltip" 
    data-placement="top" 
    title="Procesos jurídicos"
    class="btn btn-default btn-xs my-btn"
>
    <i class="fas fa-gavel"></i>
</a>
@endpermission
@permission('eliminar_credito')
<a 
    href="{{route('start.v3.creditos.destroy',$data['credito']->id)}}"
    class="btn btn-default btn-xs my-btn"
    onclick="return confirm('¿Esta seguro de eliminar el crédito?')" 
    data-toggle="tooltip"
    data-placement="top"
    title="Eliminar Crédito"
>
    <span class="glyphicon glyphicon-trash"></span>
</a>
@endpermission 