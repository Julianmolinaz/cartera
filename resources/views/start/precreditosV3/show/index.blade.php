@extends('templates.main2')

@section('title', 'ver solicitud')

@section('contenido')
    @include('start.precreditosV3.show.styles')

    <div class="obligacion-container">
        <div class="card-productos">
            @include('start.precreditosV3.show.ventas')
        </div>
        <div class="card-solicitud">
            @include('start.precreditosV3.show.solicitud')
        </div>
        <div class="card-credito">
            @if($data['credito'])
                @include('start.precreditosV3.show.credito')
            @else
                <div class="card-credito__no-active">
                    <a href="javascript:void(0);" class="card-credito__btn-activate" id="btn-activar-credito">
                        <span class="card-credito__text-activate">Activar crédito</span>
                        <i class="fa fa-power-off card-credito-icon-off" aria-hidden="true"></i>
                    </a>
                </div>
                @include('start.precreditosV3.show.activar_credito')
            @endif
        </div>
    </div>

@endsection
