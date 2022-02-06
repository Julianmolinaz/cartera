
<div class="table-responsive">
    <table class="table" style="font-size:12px">

        <tr>
        <td style="font-weight: bold;font-size: 150%;"> {{$precredito->cartera->nombre}}</td>
        <td>{{'#   '.$precredito->id}}</td>
        <th scope="row"># Consecutivo Formulario</th>
        <td>{{$precredito->num_fact}}</td>
        </tr>

        <tr>
        <th scope="row">Fecha solicitud</th>
        <td> {{$precredito->fecha}}</td>
        <th scope="row">Funcionario gestion</th>
        <td> {{$precredito->funcionario->name}}</td>
        </tr>
        <tr>
        <th scope="row">Aprobado</th>
        <td> 
            @if($precredito->aprobado == "Si")
            <span class = "label label-danger">{{ $precredito->aprobado  }}</span>
            @else
            <span class = "label label-primary">{{ $precredito->aprobado  }}</span>
            @endif  
        </td>
        <th scope="row">Producto</th>
        <td> {{$precredito->producto->nombre}}</td>
        </tr>
        <tr style="color: rgba(84,35,39,1.81);" class="warning" >
        <th scope="row">Costo del Crédito</th>
        <td> {{'$ '.  number_format($precredito->vlr_fin,0,",",".")}}</td>
        <th scope="row">Valor Cuota</th>
        <td> {{'$ '.number_format($precredito->vlr_cuota,0,",",".")}}</td>
        </tr>
        <tr>
        <th scope="row">Cuotas</th>
        <td> {{$precredito->cuotas}}</td>
        <th scope="row">Periodo</th>
        <td> {{$precredito->periodo}}</td>
        </tr> 
        <tr>
        <th scope="row">fecha 1</th>
        <td> {{$precredito->p_fecha}}</td>
        <th scope="row">fecha 2</th>
        <td> {{$precredito->s_fecha}}</td>
        </tr>
        <tr>
        <th scope="row">Estudio</th>
        <td>{{$precredito->estudio}} </td>
        <th scope="row">Cuota inicial</th>
        <td>{{'$ '.number_format($precredito->cuota_inicial,0,",",".")}} </td>
        </tr>
        <tr>
        @if($precredito->version == 1)
            <th scope="row">Calificación cliente</th>
            <td> {{$precredito->cliente->calificacion}}</td>
            <th scope="row"></th>
            <td></td>
        @elseif($precredito->version == 2)
            <th scope="row">Placa</th>
            <td colspan="4"> 
                @foreach($precredito->ref_productos as $ref)
                    <span class="label label-warning" style="color:black;font-size:1em;margin-left:1px;" 
                        data-toggle="tooltip" data-placement="top" title="{{ $ref->vehiculo->placa}}">
                            @if($ref->vehiculo->tipo_vehiculo_id == 2) <i class="fa fa-motorcycle" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 3) <i class="fa fa-motorcycle" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 4) <i class="fa fa-car" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 5) <i class="fa fa-truck" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 6) OFICIAL |
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 7) <i class="fa fa-car" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 8) <i class="fa fa-bus" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 9) <i class="fa fa-taxi" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 10) <i class="fa fa-bus" aria-hidden="true"></i>
                        @elseif($ref->vehiculo->tipo_vehiculo_id == 11) <i class="fa fa-bus" aria-hidden="true"></i>
                        @endif
                        {{ $ref->vehiculo->placa}} <span style="font-size:0.5em;">{{$ref->nombre}}</span>
                        
                    </span>
                    
                @endforeach
            </td>
        @endif
        </tr>

        
        <tr>
            <th scope="row">Registró</th>
            <td> {{$precredito->user_create->name}}</td>
            <th scope="row">Fecha</th>
            <td> {{$precredito->created_at}}</td>
        </tr>
        <tr>
            <th scope="row">Actualizó</th>
            <td> {{($precredito->user_update) ? $precredito->user_update->name : ''}}</td>
            <th scope="row">Fecha</th>
            <td> {{ ($precredito->user_update) ? $precredito->updated_at : ''}}</td>
        </tr>
        <tr>
            <th scope="row">Observaciones</th>
            <td colspan="3"> {{$precredito->observaciones}}</td>
        </tr>

    </table>
</div>

<br>
<center>
    <a href="javascript:window.history.back();">
    <button type="button" class="btn btn-primary">Volver</button></a>

    <a href="{{route('start.clientes.show',$precredito->cliente_id)}}" class = 'btn btn-primary' title="Cliente">
        <span class = "glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Ver cliente" ></span></a> 

        @if(!$precredito->credito)    
        <a href="{{route('start.precreditos.edit',$precredito->id)}}">
        <button type="button" class="btn btn-danger">Editar</button></a>
        @else
        <a href="{{route('start.creditos.edit',$precredito->credito->id)}}">
        <button type="button" class="btn btn-danger">Editar</button></a>
        @endif  
</center>
<br>
