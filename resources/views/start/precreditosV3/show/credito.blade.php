 @php   $creditoId = $data['credito']->id;
    $credito = $data['credito'];
    $cliente = $data['cliente'];
 @endphp
 
 <div class="card-header">
    <div class="card-title">Credito =2322</div>
    <div class="card-menu">
        <a href="#" class='btn btn-default btn-xs my-btn'>
            <span
                class="glyphicon glyphicon-pencil"
                data-toggle="tooltip"
                data-placement="top"
                title="Editar crédito">                            
            </span>
        </a>
        	
        <a 	href="#" 
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip" 
            data-placement="top" 
            title="Hacer Pago">
            <span class="glyphicon glyphicon-usd"></span>
        </a>
        <a 
            href="{{route('admin.sanciones.show',$creditoId)}}" 
            class='btn btn-default btn-xs my-btn' 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Sanciones diarias">
            <span class="glyphicon glyphicon-record"></span>
        </a>
        <a  
            href="{{route('admin.multas.show',$creditoId)}}" 
            class='btn btn-default btn-xs my-btn' 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Multas prejuridicas y juridicas">
            <span class="glyphicon glyphicon-hourglass"></span>
        </a>
        <a
            href="{{route('start.creditos.refinanciar',$data['solicitud']['id'])}}"
            class="btn btn-default btn-xs my-btn"
            data-toggle="tooltip" 
            data-placement="top" 
            title="Refinanciar crédito">
            <i class="fa fa-reply-all" aria-hidden="true"></i>
        </a>
        <a
            href="javascript:void(0);"
            onclick="showAcuerdo()"
            class="btn btn-default btn-xs my-btn"
            data-toggle="tooltip" 
            data-placement="top" 
            title="Acuerdos de pago">
            <span class="glyphicon glyphicon-calendar"></span>
        </a>
        <a 
            href="{{route('call.index_unique',$creditoId)}}"
		    class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip" 
            data-placement="top" 
            title="Call Center">
            <span class = "glyphicon glyphicon-phone-alt"></span>
        </a>				

        <a href="javascript:void(0);"
            onclick="showModalCertificados()"
            class='btn btn-default btn-xs my-btn'  
            data-toggle="tooltip" 
            data-placement="top" 
            title="Certificados">
            <span class = "glyphicon glyphicon-file">
        </a>
        <a href=""
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip" 
            data-placement="top" 
            title="Estado de cuenta">
            <span><i class="fab fa-laravel"></i></span>
        </a>
        <a href=""
            class="btn btn-default btn-xs my-btn"
            onclick="return confirm('¿Esta seguro de eliminar el crédito?')" 
            data-toggle="tooltip"
            data-placement="top"
            title="Eliminar Crédito">
            <span class="glyphicon glyphicon-trash"></span>
        </a>        
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
                    {{ $data['credito']->estado }}
                </span>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Fecha referencia</div>
            <div>Agosto-2019</div>
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
    @if($data['credito']->credito_padre)
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Credito padre</div>
                <div>
                    <a href="#" class="btn btn-default">{{ $data['credito']->credito_padre }}</a>
                </div>
            </div>
        </div>
    @endif
    @if($data['credito']->credito_hijo)
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Credito hijo</div>
                <div>
                    <a href="#" class="btn btn-default">{{ $data['credito']->credito_hijo }}</a>
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
                <div>Debe {{ $data['juridico']['debe'] }} de {{ $data['juridico']['total'] }}</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Prejurídico</div>
                <div>Debe {{ $data['prejuridico']['debe'] }} de {{ $data['prejuridico']['total'] }}</div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Sanciones diarias</div>
                <div class="sanciones-content">
                    <div class="sanciones-item">
                        <span class="sanciones-concept">Debe</span>
                        <span>{{ $data['credito']->sanciones_debe }}</span>
                    </div>
                    <div class="sanciones-item">
                        <span class="sanciones-concept">Ok</span>
                        <span>{{ $data['credito']->sanciones_ok }}</span>
                    </div>
                    <div class="sanciones-item">
                        <span class="sanciones-concept">Exoneradas</span>
                        <span>{{ $data['credito']->sanciones_exoneradas }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content__item">
            <div class="card-content__subitem-line">
                <div class="card-content__subitem-title">Debe de pagos parciales</div>
                <div>$ {{ $data['debe_pagos'] }}</div>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Descuentos</div>
            <div>$ {{ $data['total_descuentos'] }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem-line">
            <div class="card-content__subitem-title">Total pagos</div>
            <div>$ {{ $data['total_pagos'] }}</div>
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

