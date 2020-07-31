@extends('templates.main2')

@section('title','crear cliente') 

@section('contenido')


<div class="col-md-8 col-md-offset-2" id="principal">


    <div class="panel panel-default" style="padding:5px;" id="myabs">

        <h1 style="margin: 12px 0px 15px 10px;">
            <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
            {{ $tipo }}
        </h1>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#personales" aria-controls="personales" role="tab" :data-toggle="tab">
                    Datos Personales del Solicitante   
                </a>
            </li>
            <li role="presentation">
                <a href="#ubicacion" aria-controls="ubicacion" role="tab" :data-toggle="tab">
                    Ubicación
                </a>
            </li>
            <li role="presentation">
                <a href="#actividad" aria-controls="actividad" role="tab" :data-toggle="tab">
                    Actidad económica
                </a>
            </li>
            <li role="presentation">
                <a href="#conyuge" aria-controls="conyuge" role="tab" :data-toggle="tab">
                    Datos del Conyuge
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding:25px;">
            <div role="tabpanel" class="tab-pane active" id="personales">
                <datos_personales-component />
            </div>
            <div role="tabpanel" class="tab-pane" id="ubicacion">
                <ubicacion-component />
            </div>
            <div role="tabpanel" class="tab-pane" id="actividad">
                <actividad_economica-component />
            </div>
            <div role="tabpanel" class="tab-pane" id="conyuge">
                <datos_conyuge-component />
            </div>
            
            <p class="help-block">Los campos con asterisco (*) son obligatorios</p>

        </div>
    </div>

</div>

<script src="{{ asset('js/interfaces/cliente.js') }}"></script>
<script src="{{ asset('js/rules/cliente.js') }}"></script>
<script src="{{ asset('js/interfaces/conyuge.js') }}"></script>
<script src="/js/vue/vee_es.js"></script>

@include('start.clientes.gestion.componentes.datos_personales')
@include('start.clientes.gestion.componentes.datos_conyuge')
@include('start.clientes.gestion.componentes.datos_ubicacion')
@include('start.clientes.gestion.componentes.actividad_economica')
@include('start.clientes.gestion.componentes.oficios')
@include('start.clientes.gestion.componentes.store')

<script>

    Vue.config.devtools = true
    Vue.use(VeeValidate)
    VeeValidate.Validator.localize("es");
    let token = document.head.querySelector('meta[name="csrf-token"]');
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

    const Bus = new Vue()

    new Vue({
        el: '#principal',
        store,
        data: {
            tab     : '',
            cliente : ''
        },
        methods: {
            setCliente() {

                this.$store.commit('setGeneralInfoCliente',{
                    id: this.cliente.id,
                    calificacion: this.cliente.calificacion
                })
                this.$store.commit('setPersonal',this.cliente.info_personal)
                this.$store.commit('setUbicacion',this.cliente.info_ubicacion)
                this.$store.commit('setEconomica',this.cliente.info_economica)
                this.$store.commit('setConyuge',this.cliente.conyuge)

            }
        },
        created () {
            if (this.$store.state.estado == 'creacion') {
                this.$store.commit('setTipo',{!! json_encode($tipo) !!})
                this.tab = 'tab'
            } else {
                this.tab = 'tab'
                this.cliente = {!! json_encode($cliente) !!}
                this.setCliente()
            }

        }
    });

</script>


@endsection