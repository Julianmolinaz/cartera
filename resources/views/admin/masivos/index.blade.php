
@extends('templates.main3')

@section('title','Pagos')

@section('contenido')


<div class="container">

        <div class="row">
            <div class="col-md-12">
            
                <h3 style="position:absolute;">Listado de Archivos (Pagos Masivos)</h3>

                <a href="{{ route('admin.pagos_masivos.load') }}" class="btn btn-success" style="float: right;margin-top: 20px;">
                    Cargar Pagos Masivos
                </a>
                
            </div>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
                <hr>
                <table class="table" style="font-size:11px;width:100%" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Archivo</th>
                            <th>Creado por</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        
        </div>


</div>
@section('js')

    <script>

        $('#table').DataTable({
            processing: true,
            serverSide: true,
            order: [[0,"desc"]],
            ajax: "{{url('admin/pagos_masivos/list')}}",
            columns: [
                {data: 'id'},
                {data: 'filename'},
                {data: 'user'},
                {data: 'created_at'},
                {data: 'btn', name:'btn', orderable: false, searchable: false}
            ]
        });

    
    </script>

@endsection

@endsection