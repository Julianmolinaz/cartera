@php $creditoId = $data['credito']->id;
        $credito = $data['credito'];
@endphp 
 
 <div class="card-header {{($data['credito'] && $data['credito']->credito_padre) ? 'card-header--sky' : ''}}">
    <div class="card-title">Credito ={{ $credito->id }}</div>
    <div class="card-menu">
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
    </div>
</div>
<div class="card-content">
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Estado</div>
            <div>
                <span class="pg-tag 
                    {{ ($data['credito']->estado === 'Al dia') 
                        ? 'pg-tag--primary' 
                        : ((
                            $data['credito']->estado === 'Mora' || 
                            $data['credito']->estado === 'Prejuridico' || 
                            $data['credito']->estado === 'Juridico'
                        ) ? 'pg-tag--danger' : 'pg-tag--default')
                    }}">
                    {{ $credito->estado }}
                </span>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Fecha referencia</div>
            <div>{{ $credito->mes }} - {{ $credito->anio }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Fecha aprobación</div>
            <div>17-09-2021 09:16:09</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">
                <i class="far fa-calendar-alt"></i> Fecha de pago
            </div>
            <div style="font-weight:900">{{ ddmmyyyy($data['credito']->fecha_pago) }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Valor total crédito</div>
            <div>$ {{ decimal($data['credito']->valor_credito) }}</div>
        </div>
    </div>
    <div class="card-content__item" style="background-color: #fcee2163">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Saldo deuda</div>
             <div>$ {{ decimal($data['credito']->saldo) }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Rendimiento</div>
            <div>$ {{ decimal($data['credito']->rendimiento) }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Cuotas faltantes</div>
            <div>{{ $data['credito']->cuotas_faltantes .' de ' .$data['solicitud']['cuotas']}}</div>
        </div>
    </div>
    @if($credito->credito_padre)
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Credito padre</div>
                <div>
                    <a
                        href="{{ route('start.v3.creditos.show', $credito->credito_padre) }}"
                        class="btn btn-default"
                    >{{ $credito->credito_padre }}</a>
                </div>
            </div>
        </div>
    @endif
    @if($credito->credito_hijo)
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Credito hijo</div>
                <div>
                    <a 
                        href="{{ route('start.v3.creditos.show', $credito->credito_hijo) }}"
                        class="btn btn-default">{{ $credito->credito_hijo }}
                    </a>
                </div>
            </div>
        </div>
    @endif
    <div style="background-color: #E5E5E5">
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Saldo a favor</div>
                <div>$ {{ decimal($data['credito']->saldo_favor) }}</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Jurídico</div>
                <div>Debe {{ decimal($data['juridico']['debe']) }} de {{ decimal($data['juridico']['total']) }}</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Prejurídico</div>
                <div>Debe {{ decimal($data['prejuridico']['debe']) }} de {{ decimal($data['prejuridico']['total']) }}</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Sanciones diarias</div>
                <div class="sanciones-content">
                    <div class="sanciones-item">
                        <span class="sanciones-concept">Debe</span>
                        <span>{{ decimal($data['credito']->sanciones_debe) }}</span>
                    </div>
                    <div class="sanciones-item">
                        <span class="sanciones-concept">Ok</span>
                        <span>{{ decimal($data['credito']->sanciones_ok) }}</span>
                    </div>
                    <div class="sanciones-item">
                        <span class="sanciones-concept">Exoneradas</span>
                        <span>{{ decimal($data['credito']->sanciones_exoneradas) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Debe de pagos parciales</div>
                <div>$ {{ decimal($data['debe_pagos']) }}</div>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Descuentos</div>
            <div>$ {{ decimal($data['total_descuentos']) }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Total pagos</div>
            <div>$ {{ decimal($data['total_pagos']) }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Castigada</div>
            <div>{{ $data['credito']->castigada }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Creó</div>
            <div>
                <p>{{( $data['credito']->created_by )}}<br>
                    {{ ddmmyyyyhhmmss($data['credito']->created_at) }}
                </p>
            </div>
        </div>
    </div>
    @if($data['credito']->updated_by)
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Actualizó</div>
                <div>
                    <p>{{( $data['credito']->updated_by )}}<br>
                        {{ ddmmyyyyhhmmss($data['credito']->updated_at) }}
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>

@include('start.precreditos.acuerdos.index')
@include('start.precreditos.certificados.modal-certificados')

<script>
    function showAcuerdo() {
        $('#acuerdo').modal('show');
    }
</script>

