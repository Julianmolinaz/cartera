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

        @foreach($audits as $audit)
          <ul>
            <li style="color:blue; font-weight:bold;">Fecha: {{$audit->created_at}}  </li>
            <ul>
            <li>Evento: {{$audit->event}}             </li>
            <li>Tipo:{{$audit->type}}                 </li>
            <li>Auditable: {{$audit->auditable}}      </li>
            <li style="list-style:none;"><pre>Valor antiguo: {{$audit->old_values}} </pre></li>
            <li style="list-style:none;"><pre>Valor nuevo:{{$audit->new_values}}    </pre></li>
            <li>URL: {{$audit->url}}                  </li>
            <li>Equipo: {{$audit->user_agent}}        </li>
            <li>Responsable: {{$audit->name}}        </li>
            </ul>
          </ul>
          <hr>
        @endforeach
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


