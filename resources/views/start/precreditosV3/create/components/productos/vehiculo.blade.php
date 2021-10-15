<script type="text/x-template" id="vehiculo-template">
    <form @submit.prevent="">
        
        <div class="row">
            <div class="col-md-12">

                <!-- ELEMENTS  -->

                <div class="col-md-12">
                    <template>
                        <div class="row">

                            <!-- TIPO VEHICULO  -->

                            <div class="form-group col-md-2">
                                <label for="">Tipo Vehiculo *</label>
                                <select class="form-control">   
                                    <option selected disabled>--</option>    
                                </select>
                            </div> 

                            <!-- PLACA  -->

                            <div class="form-group col-md-2">
                                <label for="">Placa *</label>  
                                <input class="form-control">
                            </div> 

                            <!-- VENCIMIENTO SOAT  -->

                            <div class="form-group col-md-2">
                                <label for="">Vencimiento SOAT *</label>
                                <input type="date" class="form-control">              
                            </div>

                            <!-- VENCIMIENTO RTM  -->

                            <div class="form-group col-md-2">
                                <label for="">Vencimiento RTM *</label>
                                <input type="date" class="form-control">              
                            </div>

                            <div class="form-group col-md-2">
                                <label for="">Modelo *</label>
                                <input class="form-control">              
                            </div>

                            <div class="form-group col-md-2">
                                <label for="">Cilindraje *</label>
                                <input class="form-control">              
                            </div>
                        </div>
                        <br> 

                        
    
                    </template>
                </div>
                
            </div>
        </div>


    </form>
</script>

<script>
    Vue.component('vehiculo-component', {
        template: '#vehiculo-template',
        data() {
            return {
                name: 'vehiculo component'
            }
        },
        computed: {
            
        }
    });
</script>