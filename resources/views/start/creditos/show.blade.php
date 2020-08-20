@section('title','ver solicitud')

@section('contenido')


<div class="" role="main">
  <div class="">
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ver Solicitud de:  {{$precredito->cliente->nombre.' ('.$precredito->cliente->num_doc.')'}}</h2>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{route('start.creditos.create',$precredito->id)}}">
            <button type="button" class="btn btn-default">Crear Credito</button></a>


            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!--  Add content to the page ...-->
            @include('flash::message')

            <div class="row">


             <!-- *** Panel del Cliente ***-->                   
             <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">


                <table class="table">

                  <tr>
                    <td style="font-weight: bold;font-size: 150%;"> {{$precredito->cartera->nombre}}</td>
                    <td>{{'#   '.$precredito->id}}</td>
                    <th scope="row"># Consecutivo Formato</th>
                    <td>{{$precredito->num_fact}}</td>
                  </tr>

                  <tr>
                    <th scope="row">Fecha de Solicitud</th>
                    <td> {{$precredito->fecha}}</td>
                    <th scope="row">Funcionario que gestionó la solicitud</th>
                    <td> {{$precredito->funcionario->name}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Aprobado</th>
                    <td> @if($precredito->aprobado == "Si")
                     <span class = "label label-danger">{{ $precredito->aprobado  }}</span>
                     @else
                     <span class = "label label-primary">{{ $precredito->aprobado  }}</span>
                     @endif  
                   </td>
                   <th scope="row">Producto</th>
                   <td> {{$precredito->producto->nombre}}</td>
                 </tr>
                 <tr style="color: rgba(84,35,39,0.81);">
                  <th scope="row">Centro de Costo</th>
                  <td> {{$precredito->vlr_fin}}</td>
                  <th scope="row">Valor Cuota</th>
                  <td> {{$precredito->vlr_cuota}}</td>
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
                  <th scope="row">Cobro del estudio?</th>
                  <td>{{$precredito->cobro_estudio}} </td>
                </tr>
                <tr>
                  <th scope="row">Usuario que registró</th>
                  <td> {{$precredito->user_create->name}}</td>
                  <th scope="row">Fecha de ingreso al sistema</th>
                  <td> {{$precredito->created_at}}</td>
                </tr>
                <tr>
                  <th scope="row">Usuario que actualizó</th>
                  <td> {{$precredito->user_update->name}}</td>
                  <th scope="row">Fecha de actualización en el sistema</th>
                  <td> {{$precredito->updated_at}}</td>
                </tr>
                <tr>
                  <th scope="row">Observaciones</th>
                  <td colspan="3"> {{$precredito->observaciones}}</td>
                </tr>
              </table>
              <center>
                <a href="javascript:window.history.back();">
                <button type="button" class="btn btn-primary">Volver</button></a>

                <a href="{{route('start.clientes.show',$precredito->cliente_id)}}" class = 'btn btn-primary' title="Cliente">
                 <span class = "glyphicon glyphicon-user" ></a> 

                <a href="{{route('start.precreditos.edit',$credito->precredito->id)}}">
                <button type="button" class="btn btn-danger">Editar</button></a>
              </center>

            </div>
          </div>
          <!-- *** End Panel del cliente ***-->                      



        </div>

        <!--End  Add content to the page ...-->
      </div>
    </div>
  </div>
</div>
</div>
</div>

@endsection
@section('proceso','Crear cliente')
@include('templates.main')
