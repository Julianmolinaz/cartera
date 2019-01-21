@section('title','Caja')
@section('contenido')

<div class="col-md-6">
  
  <ul class="list-group">
  <li class="list-group-item">
    <span class="badge">{{ $cantidad_llamadas }}</span>
    <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
    Llamadas hoy
  </li>
<li class="list-group-item">
    <span class="badge">14</span>
    <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
    Valor negocios
  </li>
  <li class="list-group-item">
    <span class="badge">14</span>
    <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
    Solicitudes
  </li>
</ul>
</div>



@endsection
@include('templates.main2')