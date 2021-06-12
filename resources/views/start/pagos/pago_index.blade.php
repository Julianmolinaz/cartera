@section('title','Pagos')
@section('contenido')


    <div class="container body" >
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
            <div class="product_image">
              <img src="{{asset('images/logo_gora_2021.png')}}" alt="..." width="300" style="margin-bottom:30px;">
            </div>              
              <div class="mid_center">

                <form>
                  <div class="col-xs-12 form-group pull-right top_search">

					<button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm"><b>Créditos</b></button>
					<button type="button" class="btn btn-default" OnClick="Compras();"><b>Otros Pagos</b></button>

                 </div>
               
                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>


		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      

		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Créditos</h4>
		      </div>


			<div class="modal-body">
			<form class="form-horizontal">

        		<input type="number" class="form-control" placeholder="documento cliente" id="documento" >
        		<br>
        		<input type="text" class="form-control" placeholder="Si ve el nombre de en aceptar" id="nombre" disabled>
        		<input type="text" id="credito_id" hidden>
        	</form>	
      		</div>


      		<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
		        <button type="button" class="btn btn-primary" OnClick="Aceptar();">Aceptar</button>
		     </div>


		    </div><!--end modal-content-->
		  </div><!-- end modal-dialog-->
		</div><!--end modal-fade-->

	<script>

		$('#documento').on('keyup',function(){
			var doc 	= $('#documento').val();
			var route 	= "{{url('start/pagos/hay_creditos')}}/"+doc;

			$.get(route,function(data){
				if(data.res == true){
					$('#nombre').val(data.nombre);
					$('#credito_id').val(data.credito_id);
				}
			});

		});	
		function Aceptar(){
			var credito_id = $('#credito_id').val();
			var route = "{{url('start/facturas/create')}}/"+credito_id;
			window.location.href = route;			
		}

		function Compras(){
			window.location.href = "{{url('start/pagos/create')}}";
		}

	</script>



@endsection
@include('templates.main2')
