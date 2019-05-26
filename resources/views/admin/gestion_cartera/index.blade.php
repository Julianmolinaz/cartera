@section('title','carteras')

@section('contenido')

<div class="row" id="principal">
  
  <div class="col-md-3">
    @include('admin.gestion_cartera.info')
  </div>

  <div class="col-md-9">
    @include('admin.gestion_cartera.list') 
  </div>
</div>


@endsection

@include('templates.main2')