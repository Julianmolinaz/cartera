@extends('contabilidad.templates.main')

@section('contenido')

<div class="container" id="terceros-template">
    <div class="row mt-3">
        <div class="form-group col-sm-5">
            <button type="button" @click="crearTercero"
                class="btn btn-outline-primary form-controle">Crear Tercero</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-secondary mb-3 mt-3">
                <div class="card-header">Terceros</div>
                <div class="card-body">
        
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-active">
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Teléfono</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tercero in terceros">
                                <td v-text="tercero.razon_social"></th>
                                <td v-text="tercero.num_doc"></td>
                                <td v-text="tercero.tipo"></td>
                                <td v-text="tercero.tel1"></td>
                            </tr>
                        </tbody>
                    </table> 
        
                </div><!-- end card-body-->
            </div><!-- end card -->
        </div>
    </div>

    <crear_tercero-component></crear_tercero-component>
  
</div><!-- end container -->

    @section('js')

        @include('contabilidad.terceros.create')

        <script>

            Vue.use(VeeValidate)

            const Bus = new Vue();

            new Vue({
                el: '#terceros-template',
                data : {
                    a: 'Terceros',
                    terceros: ''
                },
                methods : {
                    getTerceros(){

                        var self = this;

                        axios.get('/contabilidad/terceros/list')
                            .then( res => {   
                                console.log({res});
                                                            
                                self.terceros = res.data.dat;
                            });
                    },
                    crearTercero(){
                        Bus.$emit('crearTercero')
                    }
                },
                created(){

                    var self = this;

                    this.getTerceros();

                    Bus.$on('getTerceros', () => {
                        self.getTerceros();
                    });
                }
            })

        </script>
    @endsection
@endsection