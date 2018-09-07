

    <div class="panel panel-primary">
      <div class="panel-heading">Información del Codeudor </div>


        <table class="table"  style="font-size:12px;">

          <tr>
            <th scope="row">#</th>
            @if( $cliente->codeudor->id == '100')
              <td></td>
             @else
              <td>{{ $cliente->codeudor->id}}</td>
             @endif
          </tr>

          <tr>
            <th scope="row">Nombre</th>
            <td>{{ $cliente->codeudor->nombrec }}</td>
          </tr>

          <tr>
            <th scope="row">Documento</th>
            <td> {{ $cliente->codeudor->num_docc}}</td>
          </tr>

          <tr>
            <th scope="row">Fecha de Nacimiento</th>
            <td> {{ $cliente->codeudor->fecha_nacimientoc }}</td>
          </tr>

          <tr>
            <th scope="row">Dirección</th>
            @if( $cliente->codeudor->id == '100')
              <td></td>
            @elseif($cliente->codeudor->municipio)
              <td>{{ $cliente->codeudor->direccionc.' '.$cliente->codeudor->barrioc.' - '.$cliente->codeudor->municipio->nombre.' '.$cliente->codeudor->municipio->departamento }}
              </td>
             @else
              <td></td> 
            @endif  
          </tr>

          <tr>
            <th scope="row">Telefono</th>
            <td> {{ $cliente->codeudor->movilc. ' - '. $cliente->codeudor->fijoc}}</td>
          </tr>

          <tr>
            <th scope="row">Email</th>
            <td> {{ $cliente->codeudor->emailc}}</td>
          </tr>

          <tr>
            <th scope="row">Placa</th>
            <td> {{ $cliente->codeudor->placac}}</td>
          </tr>
          @if($cliente->codeudor->conyuge)
            <tr>
              <th scope="row">Conyuge codeudor</th>
              <td>@include('start.clientes.info.conyuge_codeudor')</td>
            </tr>
          @endif
            <tr>
              <th scope="row">Ocupación</th>
              <td>@include('start.clientes.info.empresa_codeudor')</td>
            </tr>

          <tr  style="color:#FE0000;">
            <th scope="row">Estudio</th>
            @if($cliente->codeudor->estudio == NULL)
              <td> No hay estudio..</td>
            @else
              <td> {{$cliente->codeudor->estudio->cal_estudio}} </td>
            @endif
          </tr>
          @if($cliente->codeudor->soat)
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
        <a href="{{route('start.estudios.create',[$cliente->id, $cliente->codeudor->id, 'codeudor'])}}">
          <button type="button" class="btn btn-primary">Estudio</button>
        </a>
      </center>
