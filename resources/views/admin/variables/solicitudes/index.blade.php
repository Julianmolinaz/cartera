<script>
	Vue.component('solicitud-component',{
		template: `
			<div class="modal fade" tabindex="-1" role="dialog" id="solicitud_modal">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">
			        	Conceptos de facturación en solicitudes
						<button class="btn btn-default" @click="do('create')">Crear</button>
			        </h4>
			      </div>
			      <div class="modal-body">
			        <p>
						<modificacion-component></modificacion-component>
			        </p>
 					
 					<!-- Table -->
					  <table class="table table-striped">
					    <thead>
							<tr>
								<th>Nombre</th>
								<th>Estado</th>
								<th>Valor</th>
							</tr>
					    </thead>
					    <tbody>
							<tr>
								<td>1</td>
								<td>2</td>
								<td>3</td>
							</tr>
					    </tbody>
					  </table>


			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		`,
		methods: {
			do(action){
				Bus.$emit('ejecution',action);
			}
		},
		created(){
			Bus.$on('show', function(){
				$('#solicitud_modal').modal('show');
			});

			Bus.$on('ejecution', function(action){
				console.log(action);
			});
		}
	})	
</script>


