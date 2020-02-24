@section('title','variables')

@section('contenido')

<div class="row" id="variables">
<div class="col-md-8 col-md-offset-2">
	<div class="col-md-6">
		<variable-component></variable-component>
	</div>
	<div class="col-md-6" >
		<div class="list-group">
			<a href="#" class="list-group-item active">
				Otras configuraciones
			</a>
			<a href="#" class="list-group-item" @click="solicitudes">Pagos solicitudes</a>
			<a href="#" class="list-group-item">Mensajes de texto </a>
			<a href="#" class="list-group-item" @click="showConfigPagos()">Configuración de pagos</a>
			<a href="#" class="list-group-item">Vestibulum at eros</a>
		</div>
	</div>
	<solicitud-component></solicitud-component>
	<config_pagos-component></config_pagos-component>
</div>
</div>


@include('admin.variables.variables')
@include('admin.variables.solicitudes.index')
@include('admin.variables.mensajes_texto')
@include('admin.variables.solicitudes.modificacion')
@include('admin.variables.solicitudes.config_pagos')


<script>
	
	Vue.use(VeeValidate);
	var Bus = new Vue();
	
	new Vue({
		el: '#variables',
		data()	 {
			return {
				
			}
		},
		methods:{
			/*:::::::::::::::::::::::::::::::::*/
			showConfigPagos(){
				Bus.$emit('show_modal_config_pagos');
			},
			/*:::::::::::::::::::::::::::::::::*/
			solicitudes: function(){
				Bus.$emit('show');
			}
		}
	});
</script>
@endsection
@include('templates.main2')