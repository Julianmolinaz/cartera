<div class="card-header {{($data['credito'] && $data['credito']->credito_padre) ? 'card-header--sky' : ''}}">
    <div class="card-title">Solicitud ={{ $solicitud->id }}</div>
    <div class="card-menu">
        
        @include('start.precreditosV3.show.actions.btn_editar_solicitud')

        <a 
            href="{{route('start.fact_precreditos.create',$solicitud->id)}}"
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip"
            data-placement="top"
            title="Hacer pagos a solicitud"
        >
            <span class="glyphicon glyphicon-lamp"></span>
        </a>
        @permission('aprobar_solicitudes')
        <a 
            href="javascript:void(0);"
            class='btn btn-default btn-xs my-btn'
            data-toggle="tooltip"
            data-placement="top"
            title="Aprobar solicitud"
            onclick="aprobar()"
        >
            <span class="glyphicon glyphicon-retweet"></span>
        </a>
        @endpermission
    </div>
</div>
<div class="card-content">
    <div class="card-content__item">
        <div class="card-content__subitem" style="width: 70%;">
            <div class="card-content__subitem-title" style="font-size: 18px;">
                {{ $data['solicitud']['cartera']['nombre'] }}
            </div>
            <div></div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Consecutivo</div>
            <div>{{ $data['solicitud']['num_fact'] }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Aprobado</div>
            <div>
                @if($data['solicitud']['aprobado'] === 'Si')
                    <span class="pg-tag pg-tag--primary">{{ $data['solicitud']['aprobado'] }}</span>
                @else
                    <span class="pg-tag pg-tag--default">{{ $data['solicitud']['aprobado'] }}</span>
                @endif
            </div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Fecha solicitud</div>
            <div>{{ ddmmyyyy($data['solicitud']['fecha']) }}</div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Vendedor</div>
            <div>{{ $data['solicitud']['funcionario']['name'] }}</div>
        </div>
    </div>
    <div class="card-content__item" style="background-color: #fcee2163;">
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Costo crédito</div>
            <div>$ {{ decimal($data['solicitud']['vlr_fin']) }}</div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Valor cuota</div>
            <div>$ {{ decimal($data['solicitud']['vlr_cuota']) }}</div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Cuotas</div>
            <div>{{ $data['solicitud']['cuotas'] }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Periodo</div>
            <div>{{ $data['solicitud']['periodo'] }}</div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Fecha 1</div>
            <div>{{ $data['solicitud']['p_fecha'] }}</div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Fecha 2</div>
            <div>
                <span>{{ $data['solicitud']['s_fecha'] }}</span>
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Estudio</div>
            <div>{{ $data['solicitud']['estudio'] }}</div>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Cuota inicial</div>
            <div>$ {{ decimal($data['solicitud']['cuota_inicial']) }}</div>
        </div>
        <!-- <div class="card-content__subitem">
            <div class="card-content__subitem-title">Asistencia</div>
            <div>$ {{ decimal($data['solicitud']['vlr_asistencia']) }}</div>
        </div> -->
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Registró</div>
            <p>{{ $data['solicitud']['user_create']['name'] }} <br>{{ ddmmyyyyhhmmss($data['solicitud']['created_at']) }}</p>
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Actualizó</div>
            @if($data['solicitud']['user_update'] && $data['solicitud']['user_update']['name'])
                <p>{{ $data['solicitud']['user_update']['name'] }} <br>{{ ddmmyyyyhhmmss($data['solicitud']['updated_at']) }}</p>
            @endif
        </div>
        <div class="card-content__subitem">
            <div class="card-content__subitem-title"></div>
            <div></div>
        </div>
    </div>
    <div class="card-content__item">
        <div class="card-content__subitem" style="width: 100%;">
            <div class="card-content__subitem-title">
                <span>Observaciones</span>
                @permission('editar_observaciones')
                <a
                    href="javascript:void(0);"
                    style="font-weight:400;"
                    onclick="editObservaciones(
                        {{ json_encode($data['solicitud']['observaciones']) }},
                        {{ $data['solicitud']['id'] }}
                    )"
                >edit</a>
                @endpermission
            </div>
            <div>{{ $data['solicitud']['observaciones'] }}</div>
        </div>
    </div>
    @if($data['credito'])
        <div class="card-content__item">
            <div class="card-content__subitem" style="width: 100%;">
                <div class="card-content__subitem-title">
                    <span>Recordatorio</span>
                    @permission('editar_recordatorio')
                    <a
                        href="javascript:void(0);"
                        style="font-weight: 400;"
                        onclick="editRecordatorio(
                            {{ json_encode($data['credito']->recordatorio) }},
                            {{ $data['credito']->id }}
                        )"
                    >edit</a>
                    @endpermission
                </div>
                <div>{{ $data['credito']->recordatorio }}</div>
            </div>
        </div>
    @endif
</div>

@include('start.precreditosV3.show.aprobar_solicitud')
@include('start.precreditosV3.show.actions.edit_observaciones')
@include('start.precreditosV3.show.actions.edit_recordatorio')
