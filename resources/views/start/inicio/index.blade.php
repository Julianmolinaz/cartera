
@section('title','Buscador')
@section('contenido')


<div class="container body" >
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
            <div class="product_image">
              <img src="{{asset('images/logo_inversiones_gora.png')}}" alt="..." width="300" style="margin: 20px 0px;">
            </div>              
              <div class="mid_center">
	          	<div id="mandamientos" style="color: #337ab7;font-size:1.5em;margin: 0px;font-family:special-elite"></div>

                <form autocomplete="off">

                  <div class="col-xs-12">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
				          	<input type="text" id="string" class="form-control" style="width:80%; margin-left:auto; margin-right:auto;" 
                        placeholder="utilice el (=) para buscar creditos y solicitudes, ej: =0123; (*) para numero de factura; (+) para placa; (:) para telefonos ">
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

    const day = moment().day();

    switch (day) {
        case 1:
            mandamientos.innerHTML = '<p style="margin-bottom:10px;">Ser humano ante todo</p>';
            break;
        case 2:
            mandamientos.innerHTML = '<p style="margin-bottom:10px;">Pasión por lo que hacemos</p>';
            break;    
        case 3:
            mandamientos.innerHTML = '<p style="margin-bottom:10px;">Pensamiento de familia</p>';
            break;
        case 4:
            mandamientos.innerHTML = '<p style="margin-bottom:10px;">Unidos por un bien común</p>';
            break;
        case 5:
            mandamientos.innerHTML = '<p style="margin-bottom:10px;">El cliente nuestra prioridad</p>';
            break;
        case 6:
            mandamientos.innerHTML = '<p style="margin-bottom:10px;">Ser humano ante todo</p>';
            break;  
        case 7:
            mandamientos.innerHTML = '<p style="margin-bottom:10px;">Pasión por lo que hacemos</p>';
            break;                                                
        default:
            break;
    }

    var error_ = '';

    function Buscar(){
        var string = $('#string').val();
        var route  = "{{url('start/inicio/buscar')}}/"+string;

        $('#resultado').empty();

        if (!string) {
            alertify.notify('Ningun dato en el buscador ={', 'error', 5);
            return false;
        }

        $.get(route, function(res){
            if (res) {
                $('#resultado').append( res );
            } else {
                alertify.notify('No se encontraron resultados =]', 'success', 5);
            }
        })
        .fail( function(error){
            alertify.notify('Ocurrió un error inesperado =(', 'error', 5, ()=> {console.log(error)});
        })
        
    }

</script>

@endsection
@include('templates.main2')
