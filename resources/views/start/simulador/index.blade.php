@section('title','Simulador')
@section('contenido')


<div class="row">
	<div class="col-md-4 col-sm-4"></div>
	<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="panel panel-primary" style="margin-top:40px;">
  	<div class="panel-heading"><center><h2>Simulador</h2>
	  </center></div>
  	<div class="panel-body">
    


				<!--//////////////////////FORMULARIO//////////////////////////-->
				<form class="form-horizontal form-label-left">
					<input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
					<div class="form-group">
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="number" class="form-control" id="monto" autocomplete="off" autofocus="on" placeholder="Ingrese valor" required>
						</div>
					</div>
					<div class="form-group">
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="number" class="form-control" id="meses"  autocomplete="off" placeholder="Ingrese el número de meses" min="{{$variables->meses_min}}" max="{{$variables->meses_max}}" step="1">
						</div>
					</div>
					<div class="form-group">
					
					<div class="col-md-12 col-sm-12 col-xs-12">
						<select class="form-control" placeholder="rol de usuario" name="periodo" id="periodo" required>
							<option value="" disabled selected hidden="periodo">Periodo</option>
							@foreach(['Quincenal','Mensual'] as $key => $tipo)
							<option id="periodo" name="periodo" value="{{ $tipo }}" {{ (old("periodo") == $tipo ? "selected":"") }}>{{  $tipo }}</option>
							@endforeach
						</select>
					</div>
					</div>
					<br>

					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							{!! link_to('#',$title='Calcular',$attributes =  ['id'=>'registro','class'=>'btn btn-default
							 btn-lg btn-block'],$secure = null) !!}
						</div>
					</div>
					<div class="ln_solid"></div>
				</form>
				<!--///////////////////FIN FORMULARIO//////////////////////////-->
				<form class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Valor cuota:</label>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<input type="text" class="form-control" id="valor_cuota" readonly="readonly" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Cuotas:</label>
						<div class="col-md-8 col-sm-8 col-xs-12">
							<input type="text" class="form-control" id="num_cuotas" readonly="readonly" placeholder="">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>


@include('mis_js.simulador_js')



@endsection
@include('templates.main2')