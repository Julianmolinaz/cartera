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

                <div class="panel-body ">
                    <p> @include('flash::message') </p>
                    <div class="table-responsive">
                        <table id="table" class="table table-striped display" style="width:100%;">
                            <thead>
                                <tr>
                                    <th><small>     Documento    </small></th>
                                    <th><small>     Nombre       </small></th>
                                    <th><small>     Teléfono     </small></th>
                                    <th><small>     Acción       </small></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')

        <script>

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                order: [[0,"desc"]],
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

