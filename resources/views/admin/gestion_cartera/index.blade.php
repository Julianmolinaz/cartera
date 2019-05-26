@section('title','carteras')

@section('contenido')

<div class="row" id="principal">
  
  <div class="col-md-4">
    panel configuracion
  </div>
  <div class="col-md-8">
    @foreach($report as $element)
      <p>1</p>
    @endforeach
  </div>
</div>


@endsection

@include('templates.main2')