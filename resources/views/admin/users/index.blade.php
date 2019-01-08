@section('title','usuarios')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-default">

      <div class="panel-heading">Usuarios
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('admin.users.create')}}">
          <button type="button" class="btn btn-default">Crear Usuario</button></a>
        </div>
        <div class="panel-body">
          <p>
           @include('flash::message')
          
         </p>

         <table id="datatable" data-order='[[ 6, "desc" ]]' class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>    #         </th>
              <th>    Nombre    </th>
              <th>    Punto     </th>
              <th>    Municipio </th>
              <th>    Estado    </th>
              <th>    Rol       </th>
              <th>    Email     </th>
              <th style="display:none;">    Actualizacion  </th>
              <th>    Acción    </th>


            </tr>
          </thead>

          <tbody>
            @foreach($users as $user)
            <tr>
              <td> {{ $user->id    }}   </td>
              <td> {{ $user->name  }}   </td>
              <td> {{ $user->punto->nombre}}</td>
              <td> {{ $user->punto->municipio->nombre}}</td>
              <td> {{ $user->estado}}   </td>
              <td> {{ $user->rol   }}   </td>
              <td> {{ $user->email }}   </td>
              <td style="display:none;"> {{$user->updated_at}}</td>

              <td> 
                <a href="{{route('admin.users.edit',$user->id)}}" class = 'btn btn-default btn-xs'>
                  <span class = "glyphicon glyphicon-pencil" title="Editar"></span>
                </a> 
                <a href="{{route('admin.users.destroy',$user->id)}}" onclick="return confirm('¿Esta seguro de eliminar el usuario?')" class = 'btn btn-default btn-xs'>
                  <span class = "glyphicon glyphicon-trash" title="Eliminar"></span>
                </a>  
              </td>
            </tr>		

            @endforeach


          </tbody>
        </table>
      </div>
    </div>   
  </div>
</div>




@endsection
@include('templates.main2')