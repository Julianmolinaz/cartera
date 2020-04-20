<script type="text/x-template" id="ubicacion-template">
    <div>
       
       <div class="row">
            <div class="col-md-12">
                <div class="form-group col-md-6">
                    <label>Dirección *</label>
                    <input type="text" class="text form-control"
                        placeholder="dirección de residencia">
                </div>
                <div class="form-group col-md-6">
                    <label>Barrio*</label>
                    <input type="text" class="text form-control"
                        placeholder="barrio de residencia">
                </div>
            </div>
            <div class="col-md-12" >
                <div class="form-group col-md-4">
                    <label>Municipio *</label>
                    <input type="text" class="text form-control"
                        v-model="cliente.municipio_id"
                        ref="mun"
                        @keyup="getMunicipios">

                    <div class="list-group" 
                        style="position:absolute;z-index:2;background:white"
                        v-if="show_mun">
                        <a class="list-group-item list-group-item-action"
                            @click="setMunicipio(mun)"
                            v-for="mun in arr_mun">@{{mun.nombre}}-@{{mun.departamento}}</a>
                    </div>
                  
                </div>
                <div class="form-group col-md-2">
                    <label>Estrato *</label>
                    <input type="text" class="text form-control">
                </div>
                <div class="form-group col-md-3">

                    <label>Tiempo en residencia*</label>
                    <input type="text" class="text form-control" placeholder="años">

                </div>
                <div class="form-group col-md-3">
                    <label>...</label>
                    <input type="text" class="text form-control" placeholder="meses">
                </div>
            </div>
            <div class="col-md-12" style="z-index:1">
                <div class="form-group col-md-3">
                    <label>Celular</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Teléfono</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Correo electrónico</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-2">
                    <label style="font-size:10px;">Tipo de vivienda</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label style="font-size:10px;">Envío correspondencia</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Nombre arrendador</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Teléfono arrendador</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <button class="btn btn-default">Salvar</button>
                    <button class="btn btn-primary" id="continuar_act_econ">Continuar</button>
                </center>
            </div>
                
       </div>

    </div>
</script>


<script>

    Vue.component('ubicacion-component',{
        template: '#ubicacion-template',
        data () {
            return {
                show_mun : false,
                municipio: '',
                municipios: this.$store.state.municipios,
                arr_mun : [],
                cliente: this.$store.state.cliente
            }
        },
        methods: {
            getMunicipios () {
                this.arr_mun = this.municipios.filter( mun => 
                    mun.nombre.toLowerCase().includes(this.$refs.mun.value)
                )

                if (this.arr_mun) {
                    this.show_mun = true
                }
            },
            setMunicipio (municipio) {
                this.show_mun = false
                this.cliente.municipio_id = municipio.id
                this.$refs.mun.value = municipio.nombre
            }
        }
    });

</script>