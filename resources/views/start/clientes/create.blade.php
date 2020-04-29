@extends('templates.main2')

@section('title','crear cliente') 

@section('contenido')


<div class="col-md-8 col-md-offset-2" id="principal">


    <div class="panel panel-default" style="padding:5px;" id="myabs">

        <h1 style="margin: 12px 0px 15px 10px;">Cliente</h1>

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
        </div>
    </div>

</div>


@include('start.clientes.gestion.componentes.datos_personales')
@include('start.clientes.gestion.componentes.datos_conyuge')
@include('start.clientes.gestion.componentes.datos_ubicacion')
@include('start.clientes.gestion.componentes.actividad_economica')


<script src="{{ asset('js/interfaces/cliente.js') }}"></script>
<script src="{{ asset('js/interfaces/conyuge.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vuex/3.1.3/vuex.js"></script>
<script src="/js/vue/vee_es.js"></script>

<script>

    Vue.config.devtools = true
    Vue.use(VeeValidate)
    VeeValidate.Validator.localize("es");
    let token = document.head.querySelector('meta[name="csrf-token"]');
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

    const store = new Vuex.Store({
        state: {
            estado          : {!! json_encode($estado) !!},
            cliente         : new Cliente(),
            info_personal   : new InfoPersonal(),
            info_ubicacion  : new InfoUbicacion(),
            info_economica  : new InfoEconomica(),
            conyuge         : new Conyuge(),
            municipios      : {!! json_encode($municipios) !!},
            data            : {!! json_encode($data) !!}
        },
        getters: {
            getMunicipios: (state,value) => {
                var value_ = value.toLowerCase
                
                return state.municipios.filter( municipio => {
                    municipio.nombre.toLowerCase().includes(value_)
                })
            }
        },
        mutations: {
            setPersonal (state,info_personal) {
                state.info_personal = info_personal
                state.cliente.info_personale = info_personal
            },
            setUbicacion (state, info_ubicacion) {
                state.info_ubicacion = info_ubicacion
                state.cliente.info_ubicacion = info_ubicacion
            },
            setEconomica (state,info_economica) {
                state.info_economica = info_economica
                state.cliente.info_economica = info_economica
            }
        }
    })


    new Vue({
        el: '#principal',
        store,
        data: {
            tab: ''
        },
        created () {
            if (this.$store.state.estado == 'creacion') {
                this.tab = 'tab'
            } else {
                this.tab = 'tab'
            }

        } 
    });

</script>


@endsection