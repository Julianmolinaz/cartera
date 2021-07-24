@section('title','Wiki')
@section('contenido')


<div class="row" id="wiki">
    <div class="col-md-10 col-md-offset-1">
    <div class="jumbotron">
        <div class="container">
        <h1>Roles</h1>
        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Atajo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($atajos as $a)
                    <tr>
                        <td>{{ $a['atajo'] }}</td>
                        <td>{{ $a['accion'] }}</td>
                    </tr>
                @endforeach            
            </tbody>            
        </table>
        </div>
        </div>
    </div>

</div>

<script>
      $( document ).ready(function() {

        $('#datatable').dataTable( {
        'scrollY': 400,
        "scrollCollapse": true,
        "iDisplayLength": 500,
        'paging'        : false,
        'ordering'      :false

        });

        });
</script>

@endsection
@include('templates.main2')