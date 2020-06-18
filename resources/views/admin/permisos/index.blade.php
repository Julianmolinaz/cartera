@extends('templates.main2')

@section('title','permisos')
@section('contenido')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">


                <div class="panel-heading">
                    <p>
                        <h4><i class="fa fa-lock"></i>  Permisos </h4>
                    </p>
                </div>
                
                <div class="panel-body" style="margin-top:10px">

                    <p> @include('flash::message') </p>

                    <div class="row">
                        <div class="col-md-12"><a href="{{ route('admin.permisos.create')}}"
                             class="btn btn-warning" style="margin-top-3 -4px;">Crear Role</a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 10px">
                            <table id="table" class="table table-striped display" style="width:100%;">

                            <thead>
                                <tr>
                                <th>    id  </th>
                                <th>    Categoria     </th>
                                <th>    Nombre        </th>
                                <th>    Descripción   </th>
                                <th>    Estado        </th>
                                <th>    Acción        </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permisos as $permiso)
                                <tr>
                                    <td>{{ $permiso->id }}</td>
                                    <td>{{ $permiso->category }}</td>
                                    <td>{{ $permiso->display_name }}</td>
                                    <td>{{ $permiso->description }}</td>
                                    <td>{{ $permiso->status }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </div>
                        <tbody>
                        
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    @section('js')

        <script>

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{url('start/clientes/list')}}",
                columns: [
                    {data: 'num_doc'},
                    {data: 'nombre'},
                    {data: 'movil'},
                    {data: 'btn', name:'btn', orderable: false, searchable: false}
                ]
            });

        
        </script>

    @endsection

@endsection

