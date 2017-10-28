@section('title','ver sanciones')

@section('contenido')

<div class="row">

  <div class="col-md-4 col-sm-4"></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background:#0d4888; color:#ffffff;">
      Sanciones diarias, {{'crédito: '.$credito->id.'  '.
                                    $credito->precredito->cliente->nombre.' doc:  '.
                                    $credito->precredito->cliente->num_doc}}  </div>
    <div class="panel-body" style="position:relative;">
      Seleccionar todos: 
       <input type="checkbox" id="checkTodos" value="" style="background:green;">
       
     
      <input type="text" name="daterange" id="daterange" class="form-control" value=""
            style=" width: 50%; position: absolute; top: 12%; left: 35%;" />  
    
      <a href="#" class = 'btn btn-danger btn-xs' data-toggle="tooltip" data-placement="top" title="Crear Sancion/es"
      style="position:absolute;right:4%;" onclick="crearSanciones({{$credito->id}});">
          Crear
      </a>

      @include('flash::message')
    </div>

<form class="form-horizontal form-label-left" action="{{route('admin.sanciones.store')}}" method="POST">
        <?php $contador = 0; ?>
        @foreach($sanciones as $sancion)
        <?php $contador++; ?>
        <center>
        
          <div class="checkbox">
          {!!$contador!!}  
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
        <input type="hidden" name="_token" id="_token"value="{{ csrf_token() }}" />

        <center>
         <a href="javascript:window.history.back();">
          <button type="button" class="btn btn-primary">Volver</button></a>
          <button type="submit" class="btn btn-danger">Aceptar</button>         
        </center>  
        <br> 

        </form>

        

  </div>
    <div class="col-md-4 col-sm-3"></div>
</div>  
</div>


<script>

  $(function() {
   
    $('input[name="daterange"]').daterangepicker();

    $("#checkTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));  
    });

  });

  function crearSanciones(credito_id){
    var rango = $('#daterange').val();
    var id    = credito_id;
    var route = "{{url('admin/sanciones/crear_sanciones')}}";
    var token = $('#_token').val();

    $.ajax({
        url:route,
        headers: {'X-CSRF-TOKEN':token},
        type: 'POST',
        dataType:'json',
        data:{ credito_id:id , rango:rango },
        success:function(res){
          alert(res);
        }
    });
    

  }

</script>


@endsection

@include('templates.main2')


