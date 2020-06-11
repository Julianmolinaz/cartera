@extends('templates.main2')

@section('contenido')

<div class="col-md-8 col-md-offset-2" id="principal">

    <div class="panel panel-default" style="pading:5px;" id="myabs">
        <h1 style="margin: 12px 0px 15px 10px">
            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
            Solicitud
        </h1>

        <div role ="tabpanel">
        
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentacion" class="active">
                    <a href="#producto" aria-controls="producto" data-toggle="tab" role="tab">
                    Producto
                    </a>
                </li>
                <li role="presentacion">
                    <a href="#solicitud" aria-controls="solicitud" data-toggle="tab" role="tab">
                    Solicitud
                    </a>
                </li>
                <li role="presentacion">
                    <a href="#vehiculo" aria-controls="vehiculo" data-toggle="tab" role="tab">
                    Vehiculo
                    </a>
                </li>
                <li role="presentacion">
                    <a href="#credito" aria-controls="credito" data-toggle="tab" role="tab">
                    Credito
                    </a>
                </li>
            </ul>
        
            <!-- Tab panes -->
            <div class="tab-content" style="padding:25px">
                <div role="tabpanel" class="tab-pane  active" id="producto">
                    <producto-component />
                </div>      
                <div role="tabpanel" class="tab-pane" id="solicitud">
                    <solicitud-component />
                </div>
                <div role="tabpanel" class="tab-pane " id="vehiculo">
                    <vehiculo-component />
                </div>
                <div role="tabpanel" class="tab-pane" id="credito">
                    <credito-component />
                </div>

            
                
            </div><!-- tab-content  -->
        </div>  <!-- tabpanel    -->
    </div> <!-- panel  -->
 
</div><!-- .col-md-8 -->

<script src="/js/vue/vee_es.js"></script>

@include('start.precreditos.componentes.producto')
@include('start.precreditos.componentes.solicitud')
@include('start.precreditos.componentes.vehiculo')
@include('start.precreditos.componentes.credito')
@include('start.precreditos.componentes.store') 

<script>
    Vue.use(VeeValidate)
    VeeValidate.Validator.localize("es");

    const principal =new Vue({
        el: '#principal',
        store
    });

</script>

@endsection

