<div class="panel panel-primary">
<div class="panel-heading">
<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
  Información del Codeudor ...
      
  <a href="{{route('start.clientes.edit',$cliente->cdeudor->id)}}" 
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
        <th scope="row" style="height:49px;"></th>
        <td>
          <span></span>
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
        @include('start.clientes.info.personalCodeudor')
      </td>
    </tr>

    @if($cliente->conyuge)
      <tr>

        <td colspan="2" class="info">
          @include('start.clientes.info.conyuge_codeudor')
        </td>
      </tr>
    @endif

      <tr>
        <td colspan="2" class="info">@include('start.clientes.info.empresaCodeudor')</td>
      </tr>

    <tr  style="color:#FE0000;">
      <th scope="row">
          @if($cliente->cdeudor->estudio)
            <span class="glyphicon glyphicon-saved" aria-hidden="true"></span>
          @endif
          Estudio
      </th>
       
        <td>No aplica</td>
    </tr>

    <tr>
      <th scope="row">
        <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
          Núm. créditos
        </th>
      <td>No Aplica</td>
    </tr>

    <tr style="color:green; font-weight: bold;">
      <th scope="row">
      <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        Calificación
      </th>
      <td>No aplica</td>
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


    <!-- <a href="{{route('start.clientes.edit',$cliente->id)}}">
      <button type="button" class="btn btn-danger">Editar</button>
  </a> -->

</center>
