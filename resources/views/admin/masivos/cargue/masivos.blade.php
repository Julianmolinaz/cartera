
@extends('templates.main2')

@section('title','Pagos Masivos')

@section('contenido')


<div class="container">

    <div class="row col-md-12">

        <h3>Listado de pagos</h3>

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

        <br>
        <table class="table" style="font-size:10px;">
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> 
</div>

@endsection