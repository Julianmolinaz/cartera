<script type="text/x-template" id="invoice-template">
    <form @submit.prevent="">
        
        <div class="row">
            <div class="col-md-12">

                <!-- ELEMENTS  -->

                <div class="col-md-12">
                    <template >

                        <div class="row">
                        
                            <!-- FACTURACION DEL PRODUCTO  -->
                            
                            <div class="form-group col-md-12">
                                <h4 style="display:inline-block; margin-right:10px;">Facturación:
                                <!-- @{{ index + 1 +'-'+element.nombre }} -->
                                    <span style="margin-left:10px;color:#3c763d"> Total: $000.000 
                                        <!-- $@{{parseInt(element.costo)+ 
                                        parseInt(element.iva)  + 
                                        parseInt(element.otros)
                                        | formatPrice}} -->
                                    </span>
                                </h4>
                            </div>

                        </div>
                        <div class="row">
                            <!-- Expedido a -->
                            <div class="form-group col-md-4">
                                <label class="input-solicitud">Expedido a</label>
                                <select  class="form-control">
                                    <option selected disabled>--</option>
                                </select>
                            </div>
                            <!-- PROVEEDOR  -->
                            <div class="form-group col-md-4" >
                                <label class="input-solicitud">Proveedor *</label>  
                                <select class="form-control">  
                                    <option selected disabled>--</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <!-- COSTO  -->
                            <div class="form-group col-md-4" >
                                <label class="input-solicitud">Costo </label> 
                                <input class="form-control">  
                                
                            </div>
                        </div>

                        <div class="row">    
                            <!-- NUMERO DE FACTURA  -->
                            <div class="form-group col-md-2" >
                                <label class="input-solicitud">Número Factura </label>  
                                <input class="form-control">  
                            </div> 
                            <!-- FECHA DE EXPEDICION  -->
                            <div class="form-group col-md-3" >
                                <label class="input-solicitud">Fecha de Expedicion</label> 
                                <input class="form-control">

                            </div>
                            <!-- IVA  -->
                            <div class="form-group col-md-2" >
                                <label class="input-solicitud">IVA</label> 
                                <input class="form-control">
                                                         
                            </div>
                            <!-- COSTO  -->
                            <div class="form-group col-md-3" >
                                <label class="input-solicitud">Costo</label> 
                                <input class="form-control">
                                                         
                            </div>

                            <!-- ESTADO -->
                            <div class="form-group col-md-2" >
                                <label for="">Estado </label> 
                                <select class="form-control">                          
                                    <option selected disabled>--</option>
                                    
                                </select>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12" >
                                <label for="">Observaciones </label>
                                    <textarea class="form-control">
                                    </textarea>
                                
                            </div>
                        </div>
                        
                        <hr>
    
                    </template>
                </div>
                
            </div>
        </div>
        
    </form>
</script>

<script>
    Vue.component('invoice-component', {
        template: '#invoice-template',
        data() {
            return {
                name: 'invoice component'
            }
        },
        computed: {
            
        }
    });
</script>