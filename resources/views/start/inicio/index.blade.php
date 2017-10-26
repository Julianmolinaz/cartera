
@section('title','Buscador')
@section('contenido')


<div class="container body" >
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
            <div class="product_image">
              <img src="{{asset('images/gora_logo_medium.png')}}" alt="...">
            </div>              
              <div class="mid_center">

                <form autocomplete="off">

                  <div class="col-xs-12">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
				          	<input type="text" id="string" class="form-control" style="width:80%; margin-left:auto; margin-right:auto;" 
                        placeholder="utilice el = para buscar creditos y solicitudes, ej: =0123">
                    <br>
					          <button type="button" class="btn btn-default" OnClick="Buscar();" id="string_btn"><b>Voy a tener éxito!!!</b></button>
                    <br><br><br>
                 </div>
               
                </form>
                
                <div id="resultado" style="text-align: left; margin-left:11%;"></div>

                </div>
                <br><br>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>

<script>

window.onload = function() {
    document.getElementById("string").focus();
};

//Permiter hacer la busqueda pulsando enter
document.onkeypress = function(){
  var tecla;
  tecla = (document.all) ? event.keyCode : event.which;
  if(tecla == 13){
    Buscar();
    return (tecla!=13);
  }
}

    function Buscar(){
        var string = $('#string').val();
        var route  = "{{url('start/inicio/buscar')}}/"+string;

        $('#resultado').empty();

        $.get(route, function(res){
            $('#resultado').append( res );
        });
        
    }

</script>

@endsection
@include('templates.main2')