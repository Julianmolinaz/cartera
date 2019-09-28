<table class="table" style="font-size:12px">

    <tr>
    <td style="font-weight: bold;font-size: 150%;"> {{$precredito->cartera->nombre}}</td>
    <td>{{'#   '.$precredito->id}}</td>
    <th scope="row"># Factura</th>
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
    <th scope="row">Centro de Costo</th>
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
    <th scope="row">Calificación cliente</th>
    <td> {{$precredito->cliente->calificacion}}</td>
    <th scope="row"></th>
    <td></td>
    </tr>
    <tr>
    <th scope="row">Registró</th>
    <td> {{$precredito->user_create->name}}</td>
    <th scope="row">Fecha</th>
    <td> {{$precredito->created_at}}</td>
    </tr>
    <tr>
    <th scope="row">Actualizó</th>
    <td> {{$precredito->user_update->name}}</td>
    <th scope="row">Fecha</th>
    <td> {{$precredito->updated_at}}</td>
    </tr>
    <tr>
    <th scope="row">Observaciones</th>
    <td colspan="3"> {{$precredito->observaciones}}</td>
    </tr>

</table>


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