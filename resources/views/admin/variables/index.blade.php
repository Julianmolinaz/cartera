@section('title','variables')

@section('contenido')

<div class="row">
<div class="col-md-8 col-md-offset-2">
  <div class="col-md-6">
    @include('admin.variables.variables')
  </div>
  <div class="col-md-6" id="msm">
    <mensajes></mensajes>
  </div>

</div>
</div>


@include('admin.variables.mensajes_texto')

@endsection
@include('templates.main2')