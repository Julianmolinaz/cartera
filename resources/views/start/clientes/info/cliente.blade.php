<div class="panel panel-primary">
<div class="panel-heading">
  Información del Cliente 
      
  <a href="{{route('start.clientes.edit',$cliente->id)}}" 
     class = 'btn btn-default btn-xs'  
     data-toggle="tooltip" data-placement="top" 
     title="Editar"
     style="margin-left:10px;">
     <span class = "glyphicon glyphicon-pencil">
  </a>
  <a href="{{route('start.clientes.destroy',$cliente->id)}}" 
     onclick="return confirm('¿Esta seguro de eliminar el usuario?')" 
     class = 'btn btn-default btn-xs' 
     data-toggle="tooltip" 
     data-placement="top" 
     title="Eliminar">
    <span class = "glyphicon glyphicon-trash" >
  </a>
  @if($cliente->conyuge)

  @else
    <a href="{{route('start.conyuges.create',[$cliente->id,'cliente'])}}" 
      class = 'btn btn-default btn-xs'>Crear conyuge
    </a>

  @endif
</div>


  <table class="table" style="font-size:12px">

    <tr>
        <th scope="row">Documentación</th>
        <td>
          <span>@include('start.clientes.info.documentos_cliente')</span>
        </td>
    </tr>

    <tr>
      <th scope="row" class="warning">Nombre</th>
      <td class="warning">{{ $cliente->nombre }}</td>
    </tr>

    <tr>
      <th scope="row">Documento</th>
      <td> {{ $cliente->tipo_doc. ' ' .$cliente->num_doc}}</td>
    </tr>
                
    <tr>
      <th scope="row">Fecha de Nacimiento</th>
      <td> {{ $cliente->fecha_nacimiento }}</td>
    </tr>

    <tr>
      <th scope="row">Dirección</th>
      <td>{{ $cliente->direccion.' '.$cliente->barrio.' - '.$cliente->municipio->nombre.' '.$cliente->municipio->departamento }}
      </td>
    </tr>

    <tr>
      <th scope="row">Telefono</th>
      <td> {{ $cliente->movil. ' - '. $cliente->fijo}}</td>
    </tr>

    <tr>
      <th scope="row">Email</th>
      <td> {{ $cliente->email}}</td>
    </tr>

    <tr>
      <th scope="row">Placa</th>
      <td> {{ $cliente->placa}}</td>
    </tr>
    @if($cliente->conyuge)
      <tr>
        <th scope="row">Conyuge</th>
        <td>
        @include('start.clientes.info.conyuge_cliente')
        </td>
      </tr>
    @endif

      <tr>
        <th scope="row">Ocupación</th>
        <td>@include('start.clientes.info.empresa_cliente')</td>
      </tr>

    <tr  style="color:#FE0000;">
      <th scope="row">Estudio</th>
        @if($cliente->estudio == NULL)
          <td> No hay estudio..</td>
        @else
          <td>{{$cliente->estudio->cal_estudio}}</td>
        @endif
    </tr>
    @if($cliente->soat)
    <tr>
      <th scope="row">Vencimiento SOAT</th>
      <td>
      {{substr( $cliente->soat->vencimiento , 8, 3 ).
        substr( $cliente->soat->vencimiento , 4, 4 ).
        substr( $cliente->soat->vencimiento , 0, 4 )}}
      </td>
    </tr>
    @endif

    <tr>
      <th scope="row"># de créditos</th>
      <td> {{ $cliente->numero_de_creditos }}</td>
    </tr>

    <tr style="color:green; font-weight: bold;">
      <th scope="row">Calificación</th>
      <td> {{ $cliente->calificacion}}</td>
    </tr>

    <tr>
      <th scope="row">Creó</th>
      <td> {{ $cliente->user_create->name.' '.$cliente->created_at}}</td>
    </tr>
    
    <tr>
      <th scope="row">Actualizó</th>
      <td> {{ ($cliente->user_update) ? $cliente->user_update->name.' '.$cliente->updated_at : ''}}</td>
    </tr>

  </table>
</div> <!--.panel-->

<center>

    <a href="javascript:window.history.back();">
      <button type="button" class="btn btn-primary  ">
      &nbsp;&nbsp;&nbsp;&nbsp;Volver&nbsp;&nbsp;&nbsp;&nbsp;</button>
    </a>

    <a href="{{route('start.estudios.create',[$cliente->id,'0', 'cliente'])}}">
      <button type="button" class="btn btn-danger">Estudio</button>
    </a>

    <!-- <a href="{{route('start.clientes.edit',$cliente->id)}}">
      <button type="button" class="btn btn-danger">Editar</button>
  </a> -->

</center>
