@section('title','ver sanciones')

@section('contenido')

<div class="row">

  <div class="col-md-4 col-sm-4"></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background:#0d4888; color:#ffffff;">
      Sanciones diarias: <br>{{'Crédito: '.$credito->id.' -  Saldo: '.number_format($credito->saldo,0,',','.')}}
                              <br>{{$credito->precredito->cliente->nombre.' doc:  '.
                                $credito->precredito->cliente->num_doc}}  

        <select class="form-control input-sm" style="width:40%; position:absolute; top:13px; left:56%;">
            <?php
            
              $debe = 0;
              $exoneradas = 0;
              $pagadas = 0;
              
              foreach($credito->sanciones as $sancion){
                if($sancion->estado == 'Debe'){  $debe++;}
                else if($sancion->estado == 'Exonerada'){  $exoneradas++; }
                else if($sancion->estado == 'Ok'){  $pagadas++; }
              }
              echo  "<option> Debe: ".$debe."</option>".
                    "<option> Pagadas: ".$pagadas."</option>".
                    "<option>Exoneradas: ".$exoneradas."</option>";
          ?>
        </select>

     <a href="{{route('start.precreditos.ver',$credito->precredito->id)}}"
           class = 'btn btn-default btn-xs' data-toggle="tooltip" 
           data-placement="top" title="Ver crédito"
           style="right:20px; position:absolute;">
           <span class = "glyphicon glyphicon-eye-open" ></span>
        </a>
                                
                                
                                </div>  
    <div class="panel-body" style="position:relative;">

    


    <div class="form-group"> 
      <div class="col-md-8 col-sm-8 col-xs-8">        
          <input type="text" name="daterange" id="daterange" class="form-control" value="" />  
      </div>  
      <div class="col-md-4 col-sm-4 col-xs-4" >    
           <button type="button" class="btn btn-primary"  onclick="crearSanciones({{$credito->id}});" >Crear</button>
      </div>
    </div>  
<br><br>
    <div class="form-group">
      <div class="col-md-12 col-sm-12 col-xs-12">

          <label>Seleccionar todos: </label>
          <input type="checkbox" id="checkTodos" value="" />
      </div>
    </div> 

      <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="alert alert-primary" role="alert" id="alerta" style="display:none;" ></div>  
            <div>
              @include('flash::message')
            </div>
          </div>
      </div>  
 


<form class="form-horizontal form-label-left" action="{{route('admin.sanciones.store')}}" method="POST">
        <?php $contador = 0; ?>
        @foreach($sanciones as $sancion)
        <?php $contador++; ?>
        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
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
      </div>
  </div>

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
</div>

<script>

  $(function() {

    $('input[name="daterange"]').daterangepicker({
      locale:{ format:'DD/MM/YYYY'}
    });

    $("#checkTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));  
    });

  });

  var contador = 0;

  function crearSanciones(credito_id){

    if(!confirm('¿Esta seguro/a de crear las sanciones?')){
      return true;
    }

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

          $('#alerta').empty();

          if(res.error == false){
           console.log(res['creadas']);
           //alert(res.creadas.toString() );

           $('#alerta').append("<hr>Creadas: ");

           res['creadas'].forEach(function(e){
              $('#alerta').append("<tr><td>"+e+"</td></tr>");
              
           });
           $('#alerta').append("<hr>Existentes: ");

           res['existentes'].forEach(function(e){
              $('#alerta').append("<tr><td>"+e+"</td></tr>");
              
           });
           $('#alerta').append("<hr><br><button class='btn btn-warning' onclick='refrescar();'>Continuar</button>");

           $('#alerta').show();
            
          }
        }
    });
    

  }


  function refrescar(){
    location.reload();
  }

</script>


@endsection

@include('templates.main2')


