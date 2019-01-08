@section('title','multas')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-warning">

      <div class="panel-heading"><h4>Multas

        &nbsp;&nbsp;<small>[{{$credito->precredito->cliente->nombre.' '.$credito->precredito->cliente->num_doc}}]</small>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <div class="btn-group" role="group" aria-label="...">

          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menú
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#" id="crear_multa" OnClick="Crear();" data-toggle="modal" data-target="#myModalCreate">Crear Multa</a></li>
              <li><a href="javascript:window.history.back();">Volver</a></li>
            </ul>
          </div>
        </div></h4>
      </div>  
        

       <div class="panel-body">

        <p>

         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>
        <table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr>
              <th>    Credito Id    </th>
              <th>    Saldo Crédito </th>
              <th>    Estado Crédito</th>
              <th>    Fecha         </th>
              <th>    Concepto      </th>
              <th>    Estado Multa  </th>
              <th>    Total Multa   </th>
              <th>    Descripción   </th>
              <th>    Creó          </th>
              <th>    Actualizó          </th>
              <th>    Actividad     </th>
            </tr>
          </thead>
          <tbody>
          @if($credito->multas)
          @foreach($credito->multas as $multa)
          <tr>
            <td>{{$credito->id}}</td>
            <td>{{number_format($credito->saldo,0,",",".")}}</td>
            <td>{{$credito->estado}}</td>
            <td>{{$multa->fecha}}</td>
            <td>{{$multa->concepto}}</td>
            <td>{{$multa->estado}}</td>
            <td>{{number_format($multa->valor,0,",",".")}}</td>
            <td>{{$multa->descripcion}}</td>
              <td>{{ $multa->user_create->name.' '.$multa->created_at}}             </td>
              <td>{{ $multa->user_update->name.' '.$multa->updated_at}}             </td> 
            <td>
              <!--BOTON VER//////////////////////////////////////-->
              <a href="#" OnClick="Mostrar({{$multa->id}});" id="" class = 'btn btn-default btn-xs' data-toggle="modal" data-target="#myModal">
                <span class = "glyphicon glyphicon-pencil" title="editar" >
              </a>

              <a href="{{route('start.precreditos.ver',$credito->precredito->id)}}"
                  class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Ver crédito">
                  <span class = "glyphicon glyphicon-eye-open" >
                  </span>
              </a>
            </td>
          </tr>
          @endforeach    
          @endif

          </tbody>
        </table>

        @include('admin.multas.edit')
        @include('admin.multas.create')



      </div>
    </div>
  </div>
</div>



<script>




var Crear = function(){

  $('#_concepto').val('x');
  $('#_credito_id').val({{$credito->id}});
}

$('#fecha').datepicker({
    format: 'dd/mm/yyyy',
    language:"es",
});


</script>

@endsection
@include('templates.main2')