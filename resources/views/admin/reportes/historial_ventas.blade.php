@section('title','Reportes')
@section('contenido')

<div class="row">
  <div class="col-xs-12 col-md-12">
    <p>
        @include('flash::message')
        @include('templates.error')
    </p>
  </div>
</div>  
<div class="row" id="ventas">
    <div class="col-md-4 col-md-offset-2 col-xs-12 ">
        <h2 style="margin-left:23px;">Detalle venta de creditos</h2>
        <ul>
            @foreach($detalleVentas as $detalle )
                <li><a href="{{url('detallado_ventas',$detalle->getFilename())}}" style="cursor: pointer;">{{$detalle->getFilename()}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-4 col-xs-12 ">
        <h2 style="margin-left:23px;">Venta creditos por cartera</h2>
        <ul>
            @foreach($ventaCarteras as $cartera )
                <li><a href="{{url('ventas_cartera',$cartera->getFilename())}}" style="cursor: pointer;">{{$cartera->getFilename()}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<br><br>    


@endsection
@include('templates.main2')