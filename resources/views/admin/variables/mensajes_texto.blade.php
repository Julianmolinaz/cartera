<script>
	Vue.component('mensajes',{
		template: `
			<div>
				 <div class="panel panel-primary">
      				<div class="panel-heading">Mensajes de texto automáticos</div>
        				<div class="panel-body">
							<ul class="list-group">
								<li class="list-group-item">Hola Mundo</li>
								<li class="list-group-item">Hola Mundo</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		`
	})

	var msm = new Vue({
		el: '#msm',
		data: {
			a:1
		},
		methods:{
			get_mensajes: function(){
				var route = "{{ url('get-mensajes') }}";
				console.log(route);
				axios.get(route)
					.then(function(res){
						console.log('data',res);
					})
			}
		},
		mounted: function(){
			this.get_mensajes();
		}
	})

</script>