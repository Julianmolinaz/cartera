<div class="modal fade" tabindex="-1" role="dialog" id="myModalCreate">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Crear Multa</h4>
            </div>
            <div class="modal-body">
              <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">


                <form class="form-horizontal form-label-left" id="form_create">
                
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label for="">Credito Id :</label>
                      <input type="text" class="form-control input-sm"  id="_credito_id" value="" readonly >
                    </div>

                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha *:</label>
                    <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="_fecha" name="_fecha">
                  </div>
   
                </div> 

                <div class="form-group">

                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>Concepto *:</label>
                     <select class="form-control" input-sm id="_concepto">
                      <option value="x" readonly selected>- -</option>
                       @foreach($conceptos as $concepto)
                        <option value="{{$concepto}}">{{$concepto}}</option>
                       @endforeach

                     </select>  
                  </div>

                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Valor *:</label>
                    <input type="number" class="form-control" id="_valor" >
                  </div>

                </div>

                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Descripción</label>
                    <textarea class="form-control" rows="3" id="_descripcion" value="" ></textarea>
                  </div>
                </div> 
              <!-- *** BOTONES ***-->        
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" id="id" value="" />
              </form>
            </div>
          </div>

        </div>
        <div class="modal-footer">
         <center>
            <a href="#"  class = 'btn btn-primary' OnClick='SalirCreate();'>Salir</a>

            <a href="#"  class = 'btn btn-danger' id="crear" >Crear</a>
         </center>
      </div>
      </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

<script>


$('#_concepto').change(function(){
  var concepto = $('#_concepto').val();
  var credito_id = "{{$credito->id}}";
  var token      = $('#token').val();
  var route = "{{url('admin/multas/concepto')}}";

  if(concepto == 'Juridico' || concepto == 'Prejuridico'){
  
    $.ajax({
      url:route,
      headers:{'X-CSRF-TOKEN':token},
      type:'POST',
      dataType:'json',
      data:{
           credito_id:credito_id,
           concepto:concepto, 
      },
      success: function(data){ //alert(data.success);
       if(data.success == 'true'){
        alert('Existe una Multa Juridica o Prejuridica en estado "Debe", si va a crear una nueva multa dede finalizarla restandole al valor total que debe');
        $('#myModalCreate').modal('toggle');
       }
      }
     });
  }  

});

$('#crear').click(function(){

   if(validation()){ 

     var credito_id   = $('#_credito_id').val();
     var fecha        = $('#_fecha').val(); 
     var concepto     = $('#_concepto').val(); 
     var valor        = $('#_valor').val(); 
     var descripcion  = $('#_descripcion').val();
     var token        = $('#token').val();
     var route        = "{{url('admin/multas')}}";

      $.ajax({
      url:route,
      headers:{'X-CSRF-TOKEN':token},
      type:'POST',
      dataType:'json',
      data:{
           credito_id:credito_id,
           fecha:fecha, 
           concepto:concepto, 
           valor:valor,
           descripcion:descripcion
      },
      success: function(data){
        if(data.success){
          location.reload();
        }
      }
     });
    }

});

function validation(){

     var credito_id   = $('#_credito_id').val();
     var fecha        = $('#_fecha').val(); 
     var concepto     = $('#_concepto').val(); 
     var valor        = $('#_valor').val(); 
     var descripcion  = $('#_descripcion').val();
     var token        = $('#token').val();
     var route        = "{{url('admin/multas')}}";

     if( credito_id == "" || fecha == "" || concepto == "x" || valor == ""){
      alert('Los campos con "*" son obligatorios, Gracias.');
      return false;
     } else {
      return true;
     }
}

var SalirCreate = function(){ 
  $("#myModalCreate").modal('toggle'); 
}

</script>