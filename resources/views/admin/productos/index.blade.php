@section('title','productos')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-default">

      <div class="panel-heading">Productos
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('admin.productos.create')}}">
          <button type="button" class="btn btn-default">Crear producto</button></a>
        </div>
        <div class="panel-body">
          <p>
           @include('flash::message')
           <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
         </p>


         <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>    #           </th>
              <th>    Nombre      </th>
              <th>    Descripción </th>
              <th>    Acción     </th>
            </tr>
            <tbody>

              @foreach($productos as $producto)
              <tr>
                <td> {{$producto->id}}          </td>
                <td> {{$producto->nombre}}      </td>
                <td> {{$producto->descripcion}} </td>

                <td> 
                  <a href="{{route('admin.productos.edit',$producto->id)}}" class = 'btn btn-default btn-xs'>
                    <span class = "glyphicon glyphicon-pencil" title="Editar"></a>

                    </td>
                  </tr>   

                  @endforeach
                </thead>
              </table>       
            </div>
          </div>   
        </div>
      </div>




      @endsection
      @include('templates.main2')