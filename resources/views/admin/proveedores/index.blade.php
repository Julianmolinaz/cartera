@section('title','Proveedores')

@section('contenido')

    <div class="panel panel-primary">
        <div class="panel-heading">Proveedores</div>
        <div class="panel-body" id="principal">
            <div class="col-md-6">
                @include('admin.proveedores.create')
            </div>
            <div class="col-md-6">
                @include('admin.proveedores.list')
            </div>
        </div>
    </div>

@endsection

@include('templates.main2')