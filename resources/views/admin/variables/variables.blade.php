
<script>
	Vue.component('variable-component',{
		template: `
			<div class="panel panel-primary">

		      <div class="panel-heading">Variables del Sistema</div>
		        <div class="panel-body">

		        	<div v-if="message"
		        		:class="{'alert':true, 'alert-success':success,'alert-info':info, 'alert-danger':danger}" role="alert">
						@{{ message }}
		        	</div>

		          <form class="form-horizontal form-label-left fontt"
		          	@submit.prevent="onSubmit">        

		           <!-- NOMBRE**************************************************************************-->
		           <h4 class for="">Rango de Meses</h4>
		           <div class="form-group">

		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <label for="">Mínimo :</label>
		              <input type="text" class="form-control" placeholder="cantidad mín de meses" 
		              	v-model="variables.meses_min" v-validate="'required|numeric|min:1'" name="meses_min"
		              	id="meses_min" name="meses_min">
		              <span>@{{ errors.first('meses_min') }}</span>
		            </div>

		            <div class="col-md-6 col-sm-6 col-xs-12">
		              <label for="">Máximo : </label>
		              <input type="text" class="form-control" placeholder="cantidad máx de meses" 
						v-model="variables.meses_max" v-validate="'required|numeric'"
		              	id="meses_max" name="meses_max">
						<span>@{{ errors.first('meses_max') }}</span>
		            </div>
		          </div>  
		          <div class="form-group">
		            <div class="col-md-4 col-sm-4 col-xs-12">
		              <label for=""><small>Valor día de mora : </small></label>
		              <input type="text" class="form-control" placeholder="$ día mora" id="vlr_dia_sancion" name="vlr_dia_sancion" v-model="variables.vlr_dia_sancion" v-validate="'required|numeric'">
		              <span>@{{ errors.first('vlr_dia_sancion') }}</span>
		            </div>
		            <div class="col-md-4 col-sm-4 col-xs-12">
		              <label for=""><small>Vlr estudio típico : </small></label>
		              <input type="text" class="form-control" placeholder="$" id="vlr_estudio_tipico" name="vlr_estudio_tipico" v-model="variables.vlr_estudio_tipico" v-validate="'required|numeric'">
		              <span>@{{ errors.first('vlr_estudio_tipico') }}</span>
		            </div>
		            <div class="col-md-4 col-sm-4 col-xs-12">
		              <label for=""><small>Vlr estudio domicilio :</small> </label>
		              <input type="text" class="form-control" placeholder="$" id="vlr_estudio_domicilio" name="vlr_estudio_domicilio" v-model="variables.vlr_estudio_domicilio" 
		                  v-validate="'required|numeric'">
		              <span>@{{ errors.first('vlr_estudio_domicilio') }}</span>
		            </div>            
		          </div>  

		          <div class="form-group">
		            <div class="col-md-12">
		              <label for=""><small>Razón social</small></label>
		              <input type="text" class="form-control" id="razon-social" name="razon_social"
		              	v-model="variables.razon_social" v-validate="'required'">
		              	<span>@{{ errors.first('razon_social') }}</span>
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-md-12">
		              <label for=""><small>NIT</small></label>
		              <input type="text" class="form-control" id="nit" name="nit"
		              	v-model="variables.nit" v-validate="'required'">
		              	<span>@{{ errors.first('nit') }}</span>
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-md-6">
		              <label for=""><small>Tel 1</small></label>
		              <input type="text" class="form-control" id="telefono_1" name="telefono_1"
		              	v-model="variables.telefono_1" v-validate="'required'">
		              	<span>@{{ errors.first('telefono_1') }}</span>
		            </div>
		            <div class="col-md-6">
		              <label for=""><small>Tel 2</small></label>
		              <input type="text" class="form-control" id="telefono_2" name="telefono_2"
		              	v-model="variables.telefono_2">
		              	
		            </div>
		          </div>
		          <center>
		          <!-- BOTONES **************************************************************************-->
		              <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Cancelar</button></a>
		             <button type="submit" class="btn btn-danger">Guardar cambios</button>
		          </center>    
		        </form>
		      </div>
		    </div>   
		`,
		data: function(){
			return {
				variables 	: {!! json_encode($variables) !!},
				success 	: false, //true cuando se quiere mostrar mensaje exitoso
				info		: false, //true cuando se quiere mostrar mensaje informativo
				danger      : false, //true cuando se quiere mostrar mensaje de error
				message     : '', //contenedor de mensajes
			}
		},
		methods:{
			/*:::::::::::::::::::::::::::::::::*/
			onSubmit(){
				var self = this;
				var route = '/admin/variables/' + this.variables.id;
				this.success = false; this.info = false; this.danger= false; this.message='';
				this.$validator.validateAll().then(function(res){
					if(res){
						axios.put(route, self.variables)
							.then(function(res){
								console.log(res);
								if(!res.data.error){ //accion exitosa
									self.success = true;
								} else{
									if(res.data.status == 2){ // sin cambio en registro
										self.info = true;
									} else if(res.data.status == 3){ //exception al editar
										self.error = true;
									}
								}
								self.message = res.data.message;
							});
					}
				});
			}
		}
	});
</script>
<style>
	.fontt{
		font-size: 10px;
	}

	.form-control {
		font-size: 10px;
    	height: 27px;
	}
</style>