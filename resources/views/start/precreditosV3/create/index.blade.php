@extends('templates.main2')
@section('title', 'solicitud')

@section('contenido')

<div class="col-md-10 col-md-offset-1" id="principal">

    <div class="panel panel-default" style="pading:5px;" id="myabs">
        <h1 style="margin: 12px 0px 15px 10px">
            <span
                class="glyphicon glyphicon-briefcase"
                aria-hidden="true" style="color:gray;"
            ></span>
            <span v-text="this.$store.state.modo"></span> 
            <span style="font-size: 0.6em;color: #9e9a9a;" ></span>
            <a  
                class="btn btn-default btn-salir" 
                :href="rutaSalida"
            >
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                Salir
            </a>
        </h1>

        <div class="alert alert-danger" role="alert" style="margin:5px 10px;"
            v-if="$store.state.message" v-html="$store.state.message"></div>

        <div role ="tabpanel">
        
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentacion" class="active">
                    <a 
                        href="#producto" 
                        aria-controls="producto" 
                        data-toggle="tab" 
                        role="tab" 
                        @click="go('producto')"
                    >
                        <i class="fa fa-cube" aria-hidden="true" style="margin-right:5px;"></i>Producto
                    </a>
                </li>
    
                <li role="presentacion">
                    <a 
                        href="#solicitud"
                        aria-controls="solicitud"
                        data-toggle="tab"
                        role="tab"
                        @click="go('solicitud')"
                    >
                        <i class="fa fa-plug" aria-hidden="true" style="margin-right:5px;"></i>Solicitud
                    </a>
                </li>
            
                <li role="presentacion" v-if="showTabCredito">
                    <a 
                        href="#credito" 
                        aria-controls="credito" 
                        data-toggle="tab" 
                        role="tab" 
                        @click="go('credito')"
                    >
                    <i class="fa fa-rss-square" aria-hidden="true" style="margin-right:5px;"></i>Crédito
                    </a>
                </li>
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content" style="padding:25px">
                <div role="tabpanel" class="tab-pane  active" id="producto">
                    <ventas-component />
                </div>      
                <div role="tabpanel" class="tab-pane" id="solicitud">
                    <solicitud-component />
                </div>
                
                <div
                    role="tabpanel"
                    class="tab-pane"
                    id="credito"
                    v-if="showTabCredito"
                >
                    <credito-component />
                </div>
                
                <p class="help-block">Los campos con asterisco (*) son obligatorios</p>
                
            </div><!-- tab-content  -->
        </div>  <!-- tabpanel    -->
    </div> <!-- panel  -->
 
</div><!-- .col-md-8 -->


<script>
    Vue.use(VeeValidate)
    VeeValidate.Validator.localize("es");

    const Bus = new Vue();
</script>

@include('start.precreditosV3.create.components.store')
@include('start.precreditosV3.create.components.ventas._index')
@include('start.precreditosV3.create.components.solicitud')
@include('start.precreditosV3.create.components.credito')

<script>
    const principal = new Vue({
        el: '#principal',
        store,
        data: {
            view: 'producto',
            showTabCredito: false
        },
        computed: {
            rutaSalida() {
                return this.$store.getters.getRutaSalida;
            }
        },
        methods: {
            async go(view){
                await Bus.$emit('assign_'+this.view);
                this.view = view
            },
            showTabCredito_() {
                if  (
                        this.$store.state.modo !== 'Crear Solicitud' &&
                        this.$store.state.modo !== 'Editar Solicitud' &&
                        this.$store.state.modo !== 'Refinanciar Credito'
                ) {
                    this.showTabCredito = true;
                } else {
                    this.showTabCredito = false;
                }
            }
        },
        created(){
            this.showTabCredito_();
        }
    });

</script>

<style scoped>
    .btn-salir {
        float: right;
        margin: 12px 50px 0px 0px;
    }
    @media (max-width: 500px) {
        .btn-salir {
            float: none;
        }
    }
</style>


@endsection
