@section('title','Clientes')
@section('contenido')



<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <p><h2>Clientes
      <a href="#" class = 'btn btn-default btn-xs' OnClick="alert('Ayuda');" data-toggle="tooltip" data-placement="top" title="Ayuda">
                <span class = "glyphicon glyphicon-question-sign" ></span>
              </a> 
        <button type="button" class="btn btn-default pull-right" id="btn_exc">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button>
        <a href="{{route('start.clientes.create')}}">
          <button type="button" class="btn btn-warning pull-right">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
        </a>

      </h2>
      </p>
    </div>
    <div class="panel-body">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>

       <div style="display:none;">{{$fila = 1}}</div>

        <table id="datatable"  data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
              <th style="display:none;">    Actualizacion  </th>
              <th>#</th>
              <th>    Cliente id</th>
              <th>    Nombre    </th>
              <th>    Documento </th>
              <th>    Fecha de nacimiento</th>
              <th>    Teléfono  </th>
              <th>    Codeudor  </th>
              <th>    Teléfono Codeudor</th>
              <th>    Creó      </th>
              <th>    Acción    </th>

            </tr>
          </thead>

          <tbody>
          @foreach($clientes as $cliente)
          <tr>
              <td style="display:none;"> {{$cliente->updated_at}}</td>
              <td>{{$fila++}}</td>
          		<td> {{ $cliente->id }}    </td>
          		<td> {{ $cliente->nombre}} </td>
          		<td> {{ $cliente->num_doc}}</td>
              <td> {{ $cliente->fecha_nacimiento}}</td>
              <td> {{ $cliente->movil.' - '.$cliente->fijo}}</td>
<!--           		<td> {{ $cliente->municipio->nombre .' ('.$cliente->municipio->departamento.')' }}</td> -->
              <td> {{ $cliente->codeudor->nombrec }}</td>
              <td> {{ $cliente->codeudor->movilc.' - '.$cliente->codeudor->fijoc}}</td>
              <td> <small>{{ $cliente->user_create->name.' '.$cliente->created_at}}</small></td>


          		<td>
              <a href="{{route('start.clientes.show',$cliente->id)}}" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Ver"><span class = "glyphicon glyphicon-eye-open"  ></a>
              <a href="{{route('start.clientes.edit',$cliente->id)}}" class = 'btn btn-default btn-xs'  data-toggle="tooltip" data-placement="top" title="Editar"><span class = "glyphicon glyphicon-pencil"></a>
              <a href="{{route('start.clientes.destroy',$cliente->id)}}" onclick="return confirm('¿Esta seguro de eliminar el usuario?')" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Eliminar"><span class = "glyphicon glyphicon-trash" ></a>
            </td>
          </tr>

          @endforeach


          </tbody>
        </table>
      </div>
    </div>
</div>
<script>


  $( document ).ready(function() {

    $('#datatable').dataTable( {

      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  
      'scrollY': 400,
      "scrollCollapse": true

    });

  });


  $('#btn_exc').click(
    function(){
      $('#datatable').table2excel({
        name: 'clientes',
        filename: "clientes.xls"
      });
  });

</script>


@endsection
@include('templates.main2')
