@extends('templates.main2')

@section('contenido')

<div class="col-md-10 col-md-offset-1" id="principal">

    <div class="panel panel-default" style="pading:5px;" id="myabs">
        <h1 style="margin: 12px 0px 15px 10px">
            <span class="glyphicon glyphicon-briefcase" aria-hidden="true" style="color:gray;"></span>
            <span v-if="$store.state.data.status == 'edit cred'">Crédito</span> 
            <span v-else>Solicitud</span> 
            <span style="font-size: 0.6em;color: #9e9a9a;" v-text="$store.state.data.status"></span>
        </h1>

        <div role ="tabpanel">
        
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentacion" class="active">
                    <a href="#producto" aria-controls="producto" data-toggle="tab" role="tab" @click="go()">
                        <i class="fa fa-cube" aria-hidden="true" style="margin-right:5px;"></i> Producto
                    </a>
                </li>
                <li role="presentacion">
                    <a href="#solicitud" aria-controls="solicitud" data-toggle="tab" role="tab" @click="go()">
                    <i class="fa fa-plug" aria-hidden="true" style="margin-right:5px;"></i>Solicitud
                    </a>
                </li>
                @if($credito)
                <li role="presentacion">
                    <a href="#credito" aria-controls="credito" data-toggle="tab" role="tab" @click="go()">
                    <i class="fa fa-rss-square" aria-hidden="true" style="margin-right:5px;"></i>Crédito
                    </a>
                </li>
                @endif
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content" style="padding:25px">
                <div role="tabpanel" class="tab-pane  active" id="producto">
                    <producto-component />
                </div>      
                <div role="tabpanel" class="tab-pane" id="solicitud">
                    <solicitud-component />
                </div>
                @if($credito)
                <div role="tabpanel" class="tab-pane" id="credito">
                    <credito-component />
                </div>
                @endif
                <p class="help-block">Los campos con asterisco (*) son obligatorios</p>
                
            </div><!-- tab-content  -->
        </div>  <!-- tabpanel    -->
    </div> <!-- panel  -->
 
</div><!-- .col-md-8 -->

<script src="/js/vue/vee_es.js"></script>
<script src="/js/interfaces/vehiculo.js"></script>
<script src="/js/rules/vehiculo.js"></script>

<script>
    const Bus = new Vue();
</script>

@include('start.precreditos.componentes.producto')
@include('start.precreditos.componentes.solicitud')
@include('start.precreditos.componentes.credito')
@include('start.precreditos.componentes.store') 


<script>

    Vue.use(VeeValidate)
    VeeValidate.Validator.localize("es");

    const principal = new Vue({
        el: '#principal',
        store,
        methods: {
            go(){
                Bus.$emit('assign');
            }
        },
        created(){}
    });

</script>

@endsection

