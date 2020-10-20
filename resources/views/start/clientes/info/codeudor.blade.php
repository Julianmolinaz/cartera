

    <div class="panel panel-primary">
        <div class="panel-heading">Información del Codeudor 

            <a href="{{route('start.codeudores.edit',$cliente->id)}}" 
                class = 'btn btn-default btn-xs'  
                data-toggle="tooltip" data-placement="top" 
                title="Editar"
                style="margin-left:10px;">
                <span class = "glyphicon glyphicon-pencil">
            </a>
           
            <a href="{{route('start.codeudores.destroy',$cliente->id)}}" 
                onclick="return confirm('¿Esta seguro de eliminar el usuario?')" 
                class = 'btn btn-default btn-xs' 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Eliminar">
                <span class = "glyphicon glyphicon-trash" >
            </a>
            @if($cliente->version == 1 && $cliente->codeudor && !$cliente->codeudor->conyuge)
                <a href="{{route('start.conyuges.create',[$cliente->id,'codeudor'])}}" 
                    class = 'btn btn-default btn-xs'>Crear conyuge
                </a>

            @endif

        </div>


        <table class="table"  style="font-size:12px;">

            <tr>
                <th scope="row">#</th>
                <td>{{ ($cliente->codeudor) ? $cliente->codeudor->id : ''}}</td>
            </tr>

            <tr>
                <th scope="row">Nombre</th>
                <td>{{ ($cliente->codeudor) ? $cliente->codeudor->nombrec : ''}}</td>
            </tr>

            <tr>
                <th scope="row">Documento</th>
                <td> {{ ($cliente->codeudor) ? $cliente->codeudor->num_docc : ''}}</td>
            </tr>

            <tr>
                <th scope="row">Fecha de Nacimiento</th>
                <td> {{ ($cliente->codeudor) ? $cliente->codeudor->fecha_nacimientoc : '' }}</td>
            </tr>

            <tr>
                <th scope="row">Dirección</th>
                <td>{{ ($cliente->codeudor ) ? 
                        $cliente->codeudor->direccionc.' '.$cliente->codeudor->barrioc.' - '.$cliente->codeudor->municipio->nombre.' '.$cliente->codeudor->municipio->departamento 
                        :'' }}
                </td>
            </tr>

            <tr>
                <th scope="row">Telefono</th>
                <td> {{ ($cliente->codeudor) ? $cliente->codeudor->movilc. ' - '. $cliente->codeudor->fijoc : ''}}</td>
            </tr>

            <tr>
                <th scope="row">Dirección</th>
                <td> {{ $cliente->codeudor->direccionc .' - '. $cliente->codeudor->municipio->nombre }}</td>
            </tr>
            

            <tr>
                <th scope="row">Email</th>
                <td> {{ ($cliente->codeudor) ? $cliente->codeudor->emailc : ''}}</td>
            </tr>

            <tr>
                <th scope="row">Placa</th>
                <td> {{ ($cliente->codeudor) ? $cliente->codeudor->placac : ''}}</td>
            </tr>

            @if($cliente->codeudor && $cliente->codeudor->conyuge)
                <tr>
                    <th scope="row">Conyuge codeudor</th>
                    <td>@include('start.clientes.info.conyuge_codeudor')</td>
                </tr>
            @endif

            <tr>
                <th scope="row">Ocupación</th>
                <td>@include('start.clientes.info.empresa_codeudor')</td>
            </tr>

            @if($cliente->codeudor && $cliente->codeudor->soat)
            <tr>
                <th scope="row">Vencimiento SOAT</th>
                <td>
                    {{substr( $cliente->codeudor->soat->vencimiento , 8, 3 ).
                        substr( $cliente->codeudor->soat->vencimiento , 4, 4 ).
                        substr( $cliente->codeudor->soat->vencimiento , 0, 4 )}}
                </td>
            </tr>
            @endif

        </table>
      </div>

    <center>
    @if($cliente->codeudor)
        <a href="{{route('start.estudios.create',[$cliente->id, $cliente->codeudor->id, 'codeudor'])}}">
            <button type="button" class="btn btn-primary">Estudio</button>
        </a>
    @endif
    </center>
