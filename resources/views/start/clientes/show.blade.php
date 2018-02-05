@section('title','Ver Cliente')
@section('contenido')

<div class="row">
  
  <div class="col-md-1 col-sm-1"></div>
    
    <div class="col-md-5 col-sm-5 col-xs-12">

      <div class="panel panel-default">
        <div class="panel-heading">Información del Cliente </div>
          @include('flash::message')

          <table class="table"  style="font-size:12px">

            <tr>
              <th scope="row">#</th>
              <td>{{ $cliente->id}}</td>
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

            <tr>
              <th scope="row">Ocupación</th>
              <td> {{ $cliente->ocupacion}}</td>
            </tr>

            <tr>
              <th scope="row">Tipo de Actividad</th>
              <td> {{ $cliente->tipo_actividad}}</td>
            </tr>

            <tr>
              <th scope="row">Empresa</th>
              <td> {{ $cliente->empresa}}</td>
            </tr>

            <tr  style="color:#FE0000;">
              <th scope="row">Estudio</th>
                @if($cliente->estudio == NULL)
                  <td> No hay estudio..</td>
                @else
                  <td>{{$cliente->estudio->cal_estudio}}</td>
                @endif
            </tr>

            <tr>
              <th scope="row"># de créditos</th>
              <td> {{ $cliente->numero_de_creditos}}</td>
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
              <td> {{ $cliente->user_update->name.' '.$cliente->updated_at}}</td>
            </tr>

          </table>
        </div>

        <center>

        <a href="javascript:window.history.back();">
        <button type="button" class="btn btn-primary  ">&nbsp;&nbsp;&nbsp;&nbsp;Volver&nbsp;&nbsp;&nbsp;&nbsp;</button>
      </a>

          <a href="{{route('start.estudios.create',[$cliente->id,'0', 'cliente'])}}">
            <button type="button" class="btn btn-primary">Estudio</button>
          </a>

          <a href="{{route('start.clientes.edit',$cliente->id)}}">
            <button type="button" class="btn btn-danger">Editar</button>
          </a>

        </center>

    </div>



<!-- *** Panel del codeudor ***-->
  <div class="col-md-5 col-sm-5 col-xs-12">

    <div class="panel panel-default">
      <div class="panel-heading">Información del Codeudor </div>
          @include('flash::message')

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

          <tr>
            <th scope="row">Ocupación</th>
            <td> {{ $cliente->codeudor->ocupacionc}}</td>
          </tr>

          <tr>
            <th scope="row">Tipo de Actividad</th>
            <td> {{ $cliente->codeudor->tipo_actividadc}}</td>
          </tr>

          <tr>
            <th scope="row">Empresa</th>
            <td> {{ $cliente->codeudor->empresac}}</td>
          </tr>

          <tr  style="color:#FE0000;">
            <th scope="row">Estudio</th>
            @if($cliente->codeudor->estudio == NULL)
              <td> No hay estudio..</td>
            @else
              <td> {{$cliente->codeudor->estudio->cal_estudio}} </td>
            @endif
          </tr>

        </table>
      </div>

      <center>
        <a href="{{route('start.estudios.create',[$cliente->id, $cliente->codeudor->id, 'codeudor'])}}">
          <button type="button" class="btn btn-primary">Estudio</button>
        </a>
      </center>

    </div>
    <div class="col-md-1 col-sm-1"></div>

  </div>

<!-- *** End Panel del codeudor ***-->

<!--  Inicio Panel de Precreditos-->
  <br>

  <div class="row">

    <div class="col-md-1 col-sm-1"></div>

    <div class="col-md-10 col-sm-10 col-xs-12">

    <div class="panel panel-warning">
      <div class="panel-heading">
        <h4>Información de Solicitudes Y Créditos
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{route('start.precreditos.show',$cliente->id)}}">
            <button type="button" class="btn btn-danger">Crear Solicitud</button>
          </a>
        </h4>
      </div>
      @include('flash::message')
      <br>

      <table id="datatable" data-order='[[ 2, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
        <thead>
          <tr>
            <th>    Cartera         </th>
            <th>    # Crédito       </th>
            <th>    # Solicitud     </th>
            <th>    # Factura       </th>
            <th>    Centro de Costo </th>
            <th>    Vlr Cuota       </th>
            <th>    Cuotas          </th>
            <th>    Aprobado?       </th>
            <th>    Estado          </th> 
            <th>    Acción          </th>
          </tr>
        </thead>
        <tbody>

            @foreach($precreditos as $precredito)
            <tr>
            <td style="font-weight: bold;font-size: 150%;"> {{$precredito->cartera->nombre}}   </td>

            @if($precredito->credito == NULL)
              <td></td>
            @else
              <td style="font-weight: bold;font-size: 150%;">{{$precredito->credito->id}}</td>
            @endif
            <td> {{$precredito->id}}   </td>
            <td> {{$precredito->num_fact}}   </td>
            <td align="right"> {{ number_format($precredito->vlr_fin,0,",",".")}}   </td>
            <td align="right"> {{ number_format($precredito->vlr_cuota,0,",",".")}}   </td>
            <td> {{$precredito->cuotas}}   </td>
            <td> @if($precredito->aprobado == "Si")
                    <span class = "label label-danger">{{ $precredito->aprobado  }}</span>
                 @else 
                    <span class = "label label-primary">{{ $precredito->aprobado  }}</span>
                 @endif
            </td>

              @if($precredito->credito)
                <td>{{ $precredito->credito->estado }}</td>
              @else
                <td></td>
              @endif    


            <td>
              <a href="{{route('start.precreditos.ver',$precredito->id)}}"
              class = 'btn btn-default btn-xs'>
                <span class = "glyphicon glyphicon-eye-open"></span>
              </a>

              @if($precredito->credito != NULL && $precredito->credito->estado != 'Cancelado por refinanciacion')
                <a href="{{route('start.facturas.create',$precredito->credito->id)}}"
                class = 'btn btn-default btn-xs'>
                  <span class = "glyphicon glyphicon-usd"></span>
                </a>
              @endif

<!--               <a href="{{route('start.precreditos.edit',$precredito->id)}}"
              class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-pencil"></span></a> -->

               @if(!$precredito->credito)    
                  <a href="{{route('start.precreditos.edit',$precredito->id)}}"
                  class = 'btn btn-default btn-xs'> 
                      <span class = "glyphicon glyphicon-pencil"></span>
                  </a>
              @elseif($precredito->credito->estado <> 'Cancelado por refinanciacion')
              <a href="{{route('start.creditos.edit',$precredito->credito->id)}}"
                class = 'btn btn-default btn-xs'>
                <span class = "glyphicon glyphicon-pencil"></span>
              </a>
              @endif 

            </td>
          </tr>

          @endforeach
        </tbody>
      </table>

      <center>
        <a href="javascript:window.history.back();">
          <button type="button" class="btn btn-primary  ">&nbsp;&nbsp;&nbsp;&nbsp;Volver&nbsp;&nbsp;&nbsp;&nbsp;</button>
        </a>
      </center>
      <br>
    </div>
  </div>
    <div class="col-md-1 col-sm-1"></div>
  </div>
<!--  End Panel de Precreditos-->

@endsection
@include('templates.main2')
