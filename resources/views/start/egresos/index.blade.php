@section('title','Egresos')

@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4>
          <span class="glyphicon glyphicon-knight"></span> Egresos
        </h4>
      </div>
      <div class="panel-body" id="general">
        <p>
         @include('flash::message')
       </p>
       <div class="row">
          <div class="col-md-2">
            @include('start.egresos.info')
          </div>
          <div class="col-md-5">
            @include('start.egresos.create')
          </div>
          <div class="col-md-5">
            @include('start.egresos.list')
          </div>
       </div>
    </div>
  </div>
</div>     
</div>


@endsection

@include('templates.main2')
