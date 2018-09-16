
@section('title','editar cliente')
@section('contenido')

<div class="col-md-10 col-md-offset-1 col-sm-offset-1 col-sm-10 col-xs-12">

        <form class="form-horizontal form-label-left" 
              id="form" 
              action="{{route('start.clientes.update',$cliente)}}" method="POST">

         <input type="hidden" name="_method" value="PUT">

         <div class="row">

          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">Editar Cliente</div>
                <div class="panel-body">
                  @include('templates.error')
                  @include('flash::message')
                  @include('forms.clientes.cliente_edit')
                  <br><br> 
                </div>
              </div>                  
          </div>  

          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                Editar Codeudor
              </div>
                <div class="panel-body">
                   
                   @include('forms.clientes.codeudor_edit')

                </div>
              </div>     
          </div>
        </div>  

          <center>
            <a href="javascript:window.history.back();">
              <button type="button" class="btn btn-primary">Volver</button>
            </a>
           <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guardar Cambios&nbsp;&nbsp;</button>
          </center> 
          <br><br>


        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      </form>
    </div>
  </div>

</div>


<script>
  $(document).ready(function(){

  /*
  * Script que valida si se desea eliminar un codeudor asociado a un cliente
  * y asu vez si existe un estudio de crédito asociado al codeudor tambien validar su eliminación
  */

    var contenedor = '{{$cliente->codeudor->id}}';


    $('#form').submit(function(){
      var codeudor = $('input:radio[name=codeudor]:checked').val();

     if(codeudor == 'no'){

      //contenedor != '100' => codeudor no existe, el valor 100 es el id un codeudor vacio por defecto en la tabla codeudores

      if(contenedor != '100'){
        alert('El Codeudor Existe');
        var estudio = '{{$cliente->codeudor->estudio}}';
        
        if(estudio != ''){
           alert('El Codeudor tiene un estudio de crédito');
          return confirm('¿Esta seguro de eliminar el codeudor?, le recordamos que tiene asociado un estudio de crédito!');
        }
        else{
          return confirm('¿Esta seguro de eliminar el codeudor?');
        }
        
      }

     }

  });

});




</script>




    </div>
  </div>

</div>


</div>

<script>
  
 



@endsection
@include('templates.main2')