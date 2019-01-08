<script>
	
	Vue.component('modificacion-component',{
		template: `
			 <div class="panel panel-primary">
		 		<div class="panel-heading">
				    <h3 class="panel-title">Conceptos facturación solicitudes</h3>
				  </div>
			 	<div class="panel-body">
					<form @submit.prevent="onSubmit">

					  <div class="form-group">
					    <label class="col-sm-2 control-label">Concepto</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" placeholder="nombre del concepto">
					    </div>
					  </div>

					  <div class="form-group">
					    <label class="col-sm-2 control-label">Valor</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" placeholder="valor del concepto">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label">Valor</label>
					    <div class="col-sm-10">
					      <select class="form-control">
							<option value="">Activo</option>
							<option value="">Inactivo</option>
					      </select>
					    </div>
					  </div>					
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default">Sign in</button>
					    </div>
					  </div>
					</form>
				</div>
			</div>
		`,
		data:{
			return: {
				show_create: false
			}
		},
		methods:{
			onSubmit(){
				alert();
			}
		}
	})
	
</script>
