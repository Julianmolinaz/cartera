@section('title','negocios')

@section('contenido')


<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">Negocios
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('admin.negocios.create')}}"><button type="button" class="btn btn-default">Crear Negocio</button></a>

      </div>
      <div class="panel-body">

        @include('flash::message')
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>    #         </th>
                <th>    Nombre    </th>
                <th>    Descripción    </th>
                <th>    Acción    </th>
              </tr>
            </thead>

            <tbody>
              @foreach($negocios as $negocio)
              <tr>
                <td> {{ $negocio->id      }}   </td>
                <td> {{ $negocio->nombre  }}   </td>
                <td> {{ $negocio->descripcion  }}   </td>

                <td> 
                  <a  href="{{route('admin.negocios.edit',$negocio->id)}}" 
                      class = 'btn btn-default btn-xs'>
                    <span class = "glyphicon glyphicon-pencil" title="Editar"></span></a> 
                  <a  href="{{route('admin.negocios.destroy',$negocio->id)}}" 
                      onclick="return confirm('¿Esta seguro de eliminar el negocio?')" 
                      class='btn btn-default btn-xs'><span class = "glyphicon glyphicon-trash" title="Eliminar"></span></a>  
                </td>
              </tr>   

              @endforeach


            </tbody>
          </table>
        </div>
        
      </div>   
    </div>  
  </div>
  <div class="col-md-3"></div>
</div>

  @endsection

  @include('templates.main2')