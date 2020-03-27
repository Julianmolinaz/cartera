<template v-if="item">
  <div class="modal" id="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form class="form-horizontal form-label-left" v-on:submit.prevent="onSubmit()" >
        
        
        <div class="modal-body">

          <div class="row">
              <div class="col-sm-12 form-group">
              <label>Proveedor @{{item.nombre}} *</label>
                <select :name="'Proveedor'"
                        v-validate="'required'"
                        v-model="item.proveedor_id"   
                        v-bind:class="['form-control', errors.first('Proveedor') ? '_has-error' :'']">
                    <option :value="proveedor.id" v-for="proveedor in proveedores">@{{ proveedor.nombre }}</option>
                </select>
                <h6 class="text-danger">@{{ errors.first('Proveedor') }}</h6>
              </div>
          </div>

          <div class="row">
              <div class="col-sm-6 form-group">
                  <label>Número de factura @{{item.nombre}}</label>
                      <input  name="Numero de factura"
                            
                              type="text" 
                              v-model="item.num_fact"
                              v-bind:class="['form-control', errors.first('Numero de factura') ? '_has-error' :'']">
                      <h6 class="text-danger">@{{ errors.first('Numero de factura') }}</h6>
              </div>

              <div class="col-sm-6 form-group">
                  <label>Fecha Exp @{{item.nombre}}</label>
                  <input  :name="'Fecha Exp'"
                          type="date" 
                          v-model="item.fecha_exp"
                          v-bind:class="['form-control', errors.first('Fecha exp') ? '_has-error' :'']">
                  <h6 class="text-danger">@{{ errors.first('Fecha exp') }}</h6>
              </div>

          </div>

          <div class="row">

              <div class="col-sm-6 form-group">
                  <label>Costo @{{item.nombre}}*</label>
                  <input  name="Costo"
                          v-validate="'numeric'"
                          type="text" 
                          v-model="item.costo"
                          v-bind:class="['form-control', errors.first('Costo') ? '_has-error' :'']">
                  <h6 class="text-danger">@{{ errors.first('Costo') }}</h6>                        
              </div>
              <div class="col-sm-6 form-group">
                  <label>Iva @{{item.nombre}}</label>
                  <input  name="Iva"
                          v-validate="'numeric'"
                          type="text" 
                          v-model="item.iva"
                          v-bind:class="['form-control', errors.first('Iva') ? '_has-error' :'']">
                  <h6 class="text-danger">@{{ errors.first('Iva') }}</h6>                        
              </div>
          </div>

      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</template>