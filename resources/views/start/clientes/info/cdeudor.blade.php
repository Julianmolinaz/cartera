<div class="panel panel-primary">
<div class="panel-heading">
<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
  Información del Codeudor ...
      
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
    <span class = "glyphicon glyphicon-trash">
  </a>

</div>


  <table class="table" style="font-size:12px">

    <tr>
        <th scope="row">Documentación</th>
        <td>
          <span>@include('start.clientes.info.documentos_cliente')</span>
        </td>
    </tr>

    <tr class="info">
      <th scope="row">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        Nombre
      </th>
      <td><strong>{{ $cliente->cdeudor->nombre }}</strong></td>
    </tr>

    <tr>
      <th scope="row">
      <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        Documento
      </th>
      <td> {{ $cliente->cdeudor->tipo_doc. ' ' .$cliente->cdeudor->num_doc}}</td>
    </tr>
          
    <tr>
      <th scope="row">
        <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
        Telefono
      </th>
      <td> 
        {{ $cliente->cdeudor->movil. ' - '. $cliente->cdeudor->fijo}}
      </td>
    </tr>

    <tr>
      <th scope="row">
        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        Email
      </th>
      <td> {{ $cliente->cdeudor->email}}</td>
    </tr>

    <tr>
      <td colspan="2" class="info">
        @include('start.clientes.info.personal')
      </td>
    </tr>

    <!-- <tr>
      <th scope="row">Placa</th>
      <td> {{ $cliente->placa}}</td>
    </tr> -->

    @if($cliente->conyuge)
      <tr>

        <td colspan="2" class="info">
          @include('start.clientes.info.conyuge_cliente')
        </td>
      </tr>
    @endif

      <tr>
        <td colspan="2" class="info">@include('start.clientes.info.empresa_cliente')</td>
      </tr>

    <tr  style="color:#FE0000;">
      <th scope="row">
          @if($cliente->cdeudor->estudio)
            <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
          @endif
          Estudio
      </th>
        @if($cliente->estudio == NULL)
          <td> No hay estudio..</td>
        @else
          <td>{{$cliente->cdeudor->estudio->cal_estudio}}</td>
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
      <th scope="row">
        <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
          Núm. créditos
        </th>
      <td> {{ $cliente->numero_de_creditos }}</td>
    </tr>

    <tr style="color:green; font-weight: bold;">
      <th scope="row">
      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        Calificación
      </th>
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
