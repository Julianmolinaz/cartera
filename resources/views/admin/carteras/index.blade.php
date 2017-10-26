@section('title','carteras')

@section('contenido')


<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">Carteras
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('admin.carteras.create')}}"><button type="button" class="btn btn-default">Crear Cartera</button></a>

      </div>
      <div class="panel-body">


        @include('flash::message')

        <table class="table">
          <thead>
            <tr>
              <th>    #         </th>
              <th>    Nombre    </th>
              <th>    Estado    </th>
              <th>    Acción    </th>
            </tr>
          </thead>

          <tbody>
            @foreach($carteras as $cartera)
            <tr>
              <td> {{ $cartera->id      }}   </td>
              <td> {{ $cartera->nombre  }}   </td>
              <td> {{ $cartera->estado  }}   </td>

              <td> 
                <a href="" class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-eye-open" title="Ver"></span></a>
                <a href="{{route('admin.carteras.edit',$cartera->id)}}" class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-pencil" title="Editar"></span></a> 
                <a href="{{route('admin.carteras.destroy',$cartera->id)}}" onclick="return confirm('¿Esta seguro de eliminar la cartera?')" class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-trash" title="Eliminar"></span></a>  
              </td>
            </tr>   

            @endforeach


          </tbody>
        </table>



      </div>   
    </div>  
  </div>
  <div class="col-md-3"></div>
</div>

  @endsection

  @include('templates.main2')