@section('title','Wiki')
@section('contenido')


<div class="row" id="wiki">
    <div class="col-md-10 col-md-offset-1">
    <div class="jumbotron">
        <div class="container">
        <h1>Wiki Gofin-3000!</h1>
            @foreach($opciones as $opcion)
                <p><a href="{{route('wiki.opciones',$opcion)}}">{{$opcion}}</a></p>

            @endforeach
        </div>
        </div>
    </div>

</div>

@endsection
@include('templates.main2')