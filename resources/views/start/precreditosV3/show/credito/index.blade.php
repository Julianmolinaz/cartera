@php $creditoId = $data['credito']->id;
        $credito = $data['credito'];
@endphp 
 
 <div class="card-header {{($data['credito'] && $data['credito']->credito_padre) ? 'card-header--sky' : ''}}">
    <div class="card-title">Credito ={{ $credito->id }}</div>
    <div class="card-menu">
        <!-- ACCIONES -->
       @include('start.precreditosV3.show.credito.acciones')
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
            <div class="card-content__subitem-title">Fecha activacion</div>
            <div>{{ ddmmyyyyhhmmss($data['credito']->created_at) }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">
                <i class="far fa-calendar-alt"></i> Fecha de pago
            </div>
            <div>
                <span  style="font-weight:900">{{ ddmmyyyy($data['credito']->fecha_pago) }}</span>
                @permission('editar_fecha_pago')
                <a
                    href="javascript:void(0);"
                    onclick="editFechaPago(
                        '{{ $credito->fecha_pago }}', 
                        {{ $credito->id }}
                    )"
                >edit</a>
                @endpermission
            </div>
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

@include('start.precreditosV3.show.actions.edit_fecha_pago')

<script>
    function showAcuerdo() {
        $('#acuerdo').modal('show');
    }
</script>

