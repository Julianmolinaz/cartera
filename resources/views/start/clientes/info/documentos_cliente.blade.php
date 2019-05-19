<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingSeven">
      <p>
        <a role="button" data-toggle="collapse" data-parent="#accordion" 
        href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven" 
        style="font-size:12px;color:black;" class="btn btn-default btn-xs">
          Ver
        </a>
      </p>
    </div>
    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
      <div class="panel-body" style="padding:0px;" >

            <p>
                <form action="{{route('start.documentos.upload','cliente')}}" method="POST"
                      style="display:inline;"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT" >
                    <input type="file" name="file" id="" style="display:inline;">
                    <input type="hidden" value="{{$cliente->id}}" name="cliente_id">
                    <input type="submit" value="Guardar" style="display:inline;">
                    {{ csrf_field() }}
              </form>

            </p>

            <table class="table" style="font-size:10px;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cliente->documentos as $doc)
                    <tr>
                        <td>{{ $doc->nombre }}</td>
                        <td>{{ $doc->created_at }}</td>
                        <td>
                            <a href="{{ route('start.documentos.get_documento',[$doc->id,$doc->ruta]) }}" 
                               class = 'btn btn-default btn-xs' data-toggle="tooltip" 
                              data-placement="top" title="Ver" target="_blank">
                              <span class = "glyphicon glyphicon-eye-open"></a>
                            <a href="{{ route('start.documentos.destroy',$doc->id) }}" 
                               class = 'btn btn-default btn-xs' data-toggle="tooltip" 
                              data-placement="top" title="borrar" onclick="return confirm('¿Esta seguro de eliminar el documento?')">
                              <span class = "glyphicon glyphicon-trash"></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

      </div>
    </div>
  </div>
</div>
