@section('title','crear cliente')
@section('contenido')


<div class="row">

  <div class="col-md-1 col-sm-1"></div>

  <div class="col-md-10 col-sm-10 col-xs-12">


        
        <form class="form-horizontal form-label-left" action="{{route('start.clientes.store')}}" method="POST">

        <div class="row">

          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">Crear Cliente</div>
                <div class="panel-body">
                  @include('templates.error')
                    <br />
                  @include('forms.clientes.cliente')
                </div>
              </div>                  
          </div>  

          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">Crear Codeudor</div>
                <div class="panel-body">
                   
                   @include('forms.clientes.codeudor')
                </div>
              </div>     
          </div>

        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

          <center>
            <a href="{{route('start.clientes.index')}}"><button type="button" class="btn btn-primary">Volver</button></a>
            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
          </center>  

        
      </form>

    </div>
    
  <div class="col-md-1 col-sm-1"></div>
  </div>

@endsection
@include('templates.main2')