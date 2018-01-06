@section('title','auditoria')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte Auditoria del Sistema [ {{$rango['ini'].' - '.$rango['fin']}} ]
        <button id="btn_exportar" class="btn btn-warning"><b>Exportar</b></button>
      </div>
        <div class="panel-body">

        <div style="display:none;">{{$fila = 1}}</div>  

         <table id="datatable" class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
              <th>  #</th>
              <th>  Evento              </th>
              <th>  Tipo                </th>
              <th>  Auditable           </th>
              <th>  Valor anterior      </th>
              <th>  Valor nuevo         </th>
              <th>  Url                 </th>
              <th>  Agente              </th>
              <th>  Funcionario         </th>
              <th>  Fecha               </th>
            </tr>
          </thead>
          <tbody style="font-size:12px">
            @foreach($audits as $audit)
              <tr>
                <td>{{$fila++}}</td>
                <td>{{$audit->event}}</td>
                <td>{{$audit->type}}</td>
                <td>{{$audit->auditable}}</td>
                <td>{{$audit->old_values}}</td>
                <td>{{$audit->new_values}}</td>
                <td>{{$audit->url}}</td>
                <td>{{$audit->user_agent}}</td>
                <td>{{$audit->name}}</td>
                <td>{{$audit->created_at}}</td>
                
              </tr>
            @endforeach  

          </tbody>
         </table>
    </div>
  </div>
</div>
</div>

{{$audits->links()}}
<script>
$( document ).ready(function() {

  $('#datatable').dataTable( {
    'paging':false,
    'ordering':true,
    'scrollY': 400,
    "scrollCollapse": true,
    //"scrollX": true,
    //"searching": false

  });


  $('#btn_exportar').click(function(){
    $('#datatable').table2excel({
        name: 'Reporte',
        filename: "{{'repor_auditoria_'.$rango['ini'].'==='.$rango['fin'].'.xls'}}"
        });
    });

});
</script>

@endsection
@include('templates.main2')


