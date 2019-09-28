@if($precredito->credito && $precredito->credito->refinanciacion == 'Si')
<div class="panel panel-info">
@else
<div class="panel panel-primary">
@endif  

    <div class="panel-heading">Solicitud  {{' '.$precredito->cliente->nombre.' ('.$precredito->cliente->num_doc.')'}}

        @if($precredito->credito &&
            ($precredito->credito->estado == 'Al dia'     ||
            $precredito->credito->estado == 'Mora'        ||
            $precredito->credito->estado == 'Prejuridico' ||
            $precredito->credito->estado == 'Juridico'))

        <a href="{{route('start.creditos.refinanciar',$precredito->credito->id)}}">
            <button type="button" class="btn btn-warning">Refinanciar</button>
        </a>

        @elseif(!$precredito->credito)
        <div id="crear_credito">
            <a href="#" @click="setMes('{{$precredito->id}}')">
            <button type="button" id="btn_crear_credito" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" 
                title="Para crear un crédito la solicitud debe haber sido aprobada">
                Crear Credito
            </button>
            </a>
            <a href="{{route('start.fact_precreditos.create',$precredito->id)}}" class = 'btn btn-default btn-xs'>
            <span class="glyphicon glyphicon-lamp" data-toggle="tooltip" data-placement="top" title="Iniciales y estudios"></span>
            </a>

            <!-- MES REFERENCIA -->
            @include('start.precreditos.fecha_ref_modal')    
        </div>  
        @endif  
    </div>


    @include('flash::message')

    <!-- INFORMACION DE LA SOLICITUD  -->

    @include('start.precreditos.info_tbl')
</div>

<!-- CUADRO CON EL RECORDATORIO DEL CREDITO SI ESTE EXISTE -->

@if($precredito->credito && $precredito->credito->recordatorio)
<div class="panel panel-default">
    <div class="panel-body">
    <label>Recordatorio Pago</label><br>
    {{ $precredito->credito->recordatorio }}
    </div>
</div>
@endif