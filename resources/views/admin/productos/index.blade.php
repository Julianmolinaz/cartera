
@extends('templates.main3')
@section('title','productos')

@section('contenido')

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel panel-default">

        <div class="panel-heading">
            <h3 style="display: inline;">Productos</h3>
            <a 
                href="{{route('admin.productos.create')}}" 
                class="btn btn-default"
                style="float:right;"
            >
                Crear producto
            </a>
        </div>
        <div class="panel-body">
          <p>
           @include('flash::message')
           <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
         </p>

          <div class="table-responsive">
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
  </div>

    <script>
        $("#table-productos").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{url('/api/productos/list')}}",
            order: [[0, 'desc']],
            columns: [
                { data: 'id' },
                { data: 'nombre' },
                {
                    render: (data, type, row) => {
                        let result = row.estado ? "Activo" : "Inactivo";
                        return result;
                    }
                },
                {
                    render: (data, type, row) => {
                        let result = row.descripcion.substr(0, 30) + " ...";
                        return result;
                    }
                },
                {
                    render: (data, type, row) => {
                        let result = (row.con_vehiculo) ? "Si" : "No";
                        return result;
                    }
                },
                {
                    render: (data, type, row) => {
                        let result = (row.con_invoice) ? "Si" : "No";
                        return result;
                    }
                },
                {
                    render: (data, type, row) => {
                        let routeEdit = "/admin/productos/edit/" + row.id ;
                        let routeDelete = "/admin/productos/destroy/" + row.id;
                        let html = `
                            <a href="${routeEdit}" class='btn btn-default btn-xs'>
                                <span class = "glyphicon glyphicon-pencil" title="Editar">
                            <a/>
                            <a href="${routeDelete}" class='btn btn-default btn-xs'>
                                <span class = "glyphicon glyphicon-trash" title="Eliminar">
                            <a/>
                        `;
                        return html;
            
                    }
                }
                
            ]
        })
    </script>

    @endsection
