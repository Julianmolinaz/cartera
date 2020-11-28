
@extends('templates.main2')

@section('title','Pagos Masivos')

@section('contenido')


<div class="container">

    <div class="row col-md-12">

        <h3 style="position:absolute;">Listado de Pagos</h3>

        <a href="{{ route('admin.pagos_masivos.load') }}" class="btn btn-success" style="float: right;margin-top: 20px;">
            Cargar Pagos Masivos
        </a>


        <br><br><br>

        <hr>
        <div class="col-md-4">
            <dl>
                <dt>Archivo</dt>
                <dd>{{ $load->filename }}</dd>
            </dl>
        </div>
        <div class="col-md-4">
            <dl>
                <dt>Registrado por</dt>
                <dd>{{ $load->creator->name }}</dd>
            </dl>
        </div>
        <div class="col-md-4">
            <dl>
                <dt>Registrado en</dt>
                <dd>{{ $load->created_at }}</dd>
            </dl>
        </div>

        <br><br>
        <hr>
        <table class="table">
            <head>
                <tr>
                    <th>Documento</th>
                    <th>Credito</th>
                    <th>Solicitud</th>
                    <th>N. Factura</th>
                    <th>Fecha</th>
                    <th>Referencia</th>
                    <th>Monto</th>
                    <th>Entidad</th>
                    <th>Acción</th>
                </tr>
            </head>
            <tbody>
                @foreach($load->masivos as $item)
                    <tr>
                        <td>{{$item->documento}}</td>
                        <td>{{$item->credito ? $item->credito->id : ''}}</td>
                        <td>{{$item->precredito ? $item->precredito->id : ''}}</td>

                        @if($item->credito && $item->pago) 
                            <td>{{ (isset($item->pago->num_fact)) ? $item->pago->num_fact : 'Sin registro' }}</td>
                        @elseif($item->precredito && $item->pago)
                            <td>{{ (isset($item->pago->num_fact)) ? $item->pago->num_fact : 'Sin registro' }}</td>
                        @else   
                            <td></td>
                        @endif

                        <td>{{ $item->fecha}}</td>
                        <td>{{$item->referencia}}</td>
                        <td>{{$item->monto}}</td>
                        <td>{{$item->entidad}}</td>
                        <td>
                            @if($item->credito && $item->pago)
                                <a href="{{route('start.facturas.show',$item->ref_recibo_id)}}" target="_blank" class='btn btn-default btn-xs'>
                                    <span class="glyphicon glyphicon-eye-open"  data-toggle="tooltip" data-placement="top" title="Ver Factura"></span>
                                </a>
                            @endif
                            @if($item->credito)
                                <a href="{{route('start.creditos.show', [$item->credito])}}" target="_blank" class='btn btn-default btn-xs'>
                                    <span class="glyphicon glyphicon-sunglasses" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver Crédito"></span>
                                </a>
                            @endif
                            @if($item->ref_type == 'App\\Precredito')
                                <a href="{{route('start.precred_pagos.show',$item->ref_recibo_id)}}" target="_blank" class='btn btn-default btn-xs'>
                                    <span class="glyphicon glyphicon-eye-open"  data-toggle="tooltip" data-placement="top" title="Ver Factura"></span>
                                </a>
 
                                <a href="{{route('start.precreditos.ver', [$item->ref_id])}}" target="_blank" class='btn btn-default btn-xs'>
                                    <span class="glyphicon glyphicon-sunglasses" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver Crédito"></span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
</div>

@endsection