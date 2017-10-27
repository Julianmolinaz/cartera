@section('title','ver sanciones')

@section('contenido')

<div class="row">

  <div class="col-md-4 col-sm-4"></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background:#0d4888; color:#ffffff;">
    Sanciones diarias, 
    {{'crédito: '.$credito->id.'  '.$credito->precredito->cliente->nombre.' doc:  '.$credito->precredito->cliente->num_doc}}</div>
    <div class="panel-body">
      Seleccionar todos: 
      <input type="checkbox" id="checkTodos" value="">
      <a type="button" href="{{route('admin.sanciones.create')}}" class="btn btn-default btn-xs" style="position:absolute; right:43px; background:#ffc203;">Crear sanciones diarias</a>
      @include('flash::message')
    </div>

<form class="form-horizontal form-label-left" action="{{route('admin.sanciones.store')}}" method="POST">

        @foreach($sanciones as $sancion)
        <center>
        
          <div class="checkbox">
            <label>
            @if($sancion->estado != 'Debe')

              @if($sancion->estado == 'Ok')
                <input type="checkbox" name="{{$sancion->id}}" value="{{$sancion->id}}" disabled checked>
                {{' Fecha: '.$sancion->created_at}}
              @else
                <input type="checkbox" name="{{$sancion->id}}" value="{{$sancion->id}}" checked>
                {{' Fecha: '.$sancion->created_at}}

              @endif
              
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

<script>
  $("#checkTodos").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
</script>


@endsection

@include('templates.main2')

