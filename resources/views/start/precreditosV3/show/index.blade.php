@extends('templates.main2')

 @php   $user = Auth::user();
        $cliente = $data['cliente'];
        $solicitud = (object)$data['solicitud'];
 @endphp

@section('title', 'ver solicitud')

@section('contenido')
    @include('start.precreditosV3.show.styles')
    @include('flash::message')

    <div class="col-md-12 info-cliente-container">
        @include("start.precreditosV3.show.cliente")
    </div>
    <div class="col-md-12 obligacion-container">
        <div class="card-productos">
            @include('start.precreditosV3.show.ventas.index')
        </div>
        <div class="card-solicitud">
            @include('start.precreditosV3.show.solicitud')
        </div>
        <div class="card-credito">
            @if($data['credito'])
                @include('start.precreditosV3.show.credito.index')
            @else
                <div class="card-credito__no-active">
                    @permission('activar_credito')
                        <a href="javascript:void(0);" class="card-credito__btn-activate" id="btn-activar-credito">
                    @endpermission
                            <span class="card-credito__text-activate">Activar crédito</span>
                    @permission('activar_credito')
                            <i class="fa fa-power-off card-credito-icon-off" aria-hidden="true"></i>
                        </a>
                    @endpermission
                </div>
                @include('start.precreditosV3.show.activar_credito')
            @endif
        </div>
    </div>

    @if($data['pagos_solicitud'])
    <div class="col-md-12 pagos-solicitud-container">
        @include('start.precreditosV3.show.pagos_solicitud')
    </div>
    @endif

    @if($data['pagos_credito'])
    <div class="col-md-12 pagos-credito-container">
        @include('start.precreditosV3.show.pagos_credito')
    </div>
    @endif

    @if($data['llamadas'])
    <div class="col-md-12 llamadas-container">
        @include('start.precreditosV3.show.llamadas')
    </div>
    @endif

@endsection
