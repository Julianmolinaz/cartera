@extends('templates.main3')

@section('title','Clientes')
@section('contenido')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">


                <div class="panel-heading">

                    <p>
                        <h4>Clientes <i class="fas fa-users"></i></h4>
                    </p>

                </div>


                <div class="panel-body">

                    <p> @include('flash::message') </p>


                    <table id="table" class="table table-striped display" style="width:100%;">

                        <thead>
                            <tr>
                            <th>    Documento  </th>
                            <th>    Nombre     </th>
                            <th>    Teléfono   </th>
                            <th>    Acción     </th>

                            </tr>
                        </thead>
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

