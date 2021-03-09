@section('title','crear cliente')
@section('contenido')

    <div class="col-md-6 col-sm-12">
        <center>
            <h4>{{ $cliente->nombre }}</h4>
            <h5>{{ $cliente->tipo_doc .' : '.$cliente->num_doc }}</h5>
            <br>
            <img src="{{ asset('images/folder.png') }}" width='200'>
        </center>
        <br>

        @include('templates.error')
        @include('flash::message')

        <p>
            <form action="{{route('start.documentos.upload','inicio')}}" method="POST"
                    style="display:inline;"
                    enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT" >
                <input type="file" name="file" id="" style="display:inline;">
                <input type="hidden" value="{{$cliente->id}}" name="cliente_id">
                <input type="submit" value="Guardar" style="display:inline;">
                {{ csrf_field() }}
            </form>
        </p>

        <br>

        @foreach($cliente->documentos as $doc)
            <hr>
            <p>Documento : {{ $doc->nombre }}</p>
            <p>Fecha : {{ $doc->created_at }}</p>
            <p class="pull-right">
                <a href="{{ route('start.documentos.destroy',[$doc->id,1]) }}" 
                    class = 'btn btn-danger btn-xs' data-toggle="tooltip" 
                    data-placement="top" title="borrar" 
                    onclick="return confirm('¿Esta seguro de eliminar el documento?')">
                    <span class = "glyphicon glyphicon-trash"></a>

                <a href="{{ route('start.documentos.get_documento',[$doc->id,$doc->ruta]) }}" 
                    class = 'btn btn-primary' data-toggle="tooltip" 
                    data-placement="top" title="Ver" target="_blank"> &nbsp;&nbsp;Ver documento &nbsp;&nbsp;
                <span class = "glyphicon glyphicon-eye-open"></a>
            </p>
            <br><br>
        @endforeach
        <hr>
        <br>
    </div>

@endsection
@include('templates.main2')