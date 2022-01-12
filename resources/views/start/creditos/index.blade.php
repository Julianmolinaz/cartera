@extends('templates.main3')

@section('title','Creditos')
@section('contenido')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary">


                <div class="panel-heading">

                    <p>
                        <h4>Créditos <i class="fas fa-users"></i></h4>
                    </p>

                </div>


                <div class="panel-body">

                    <p> @include('flash::message') </p>


                    <table id="table" class="table table-striped display" style="width:100%;">

                        <thead>
                            <tr>
                                <th>    Código crédito </th>
                                <th>    Código solicitud</th>
                                <th>    Estado     </th>
                                <th>    Cartera  </th>
                                <th>    Nombre     </th>
                                <th>    Documento </th>
                                <th>    Acciones   </th>
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
                ajax: "{{url('start/creditos/list')}}",
                columns: [
                    {data: 'id', name: 'creditos.id'},
                    {data: 'precredito_id', name: 'precreditos.id'},
                    {data: 'estado', name: 'creditos.estado'},
                    {data: 'cartera', name: 'carteras.nombre'},
                    {data: 'nombre', name: 'clientes.nombre'},
                    {data: 'num_doc', name: 'clientes.num_doc'},
                    {data: 'btn', searchable: false}
                ],
                order: [[0, 'desc']]
            });

        
        </script>

    @endsection

@endsection

