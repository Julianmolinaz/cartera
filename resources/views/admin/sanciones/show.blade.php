@section('title','ver sanciones')

@section('contenido')

<div class="row">

  <div class="col-md-4 col-sm-4"></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Panel heading</div>
    <div class="panel-body">
      <b>{{'Credito: '.$credito->id.'  '.$credito->precredito->cliente->nombre.' 
                (doc:  '.$credito->precredito->cliente->num_doc.')'}}</b>
    </div>

<form class="form-horizontal form-label-left" action="{{route('admin.sanciones.store')}}" method="POST">

        @foreach($sanciones as $sancion)
        <center>
        
          <div class="checkbox">
            <label>
            @if($sancion->estado != 'Debe')
              <input type="checkbox" name="{{$sancion->id}}" value="{{$sancion->id}}" checked>
              {{' Fecha: '.$sancion->created_at}}
            @else
              <input type="checkbox" name="{{$sancion->id}}" value="{{$sancion->id}}">
              {{' Fecha: '.$sancion->created_at}}
            @endif    
            </label>
          </div>
        </center>

        @endforeach

        <br><br>
        <input type="hidden" name="credito_id" value="{{ $credito->id }}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <center>
         <a href="javascript:window.history.back();">
          <button type="button" class="btn btn-primary">Volver</button></a>
          <button type="submit" class="btn btn-danger">Aceptar</button>         
        </center>  
        <br> 

        </form>

  </div>
    <div class="col-md-4 col-sm-4"></div>
</div>  
</div>

@endsection

@include('templates.main2')