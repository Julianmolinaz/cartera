<script src="/js/vue/vuex.js"></script>
<script src="{{ asset('js/SolicitudV3/Solicitud.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Credito.js') }}"></script>

<script>
    const store = new Vuex.Store({
        state: {
            data                : {!! json_encode($data) !!}, // Insumos solicitud
            insumos             : {!! json_encode($insumos) !!}, // Insumos Venta
            insumosCredito      : {!! json_encode($creditos) !!}, 
            continuarASolicitud : true,
            ventas              : [],
            solicitud           : new Solicitud({}),
            credito             : new Credito({}),
            listaVehiculos      : [],
        },
        getters: { 
            getContinuarASolicitud(state) {
                return state.continuarASolicitud;
            }
        },
        mutations: {
            setContinuarASolicitud(state, response) {
                state.continuarASolicitud = response;
            },
            setVentas(state, ventas) {
                state.ventas = ventas;
            },
            setSolicitud(state, solicitud) {
                state.solicitud = solicitud;
            },
            setCreditos(state, credito) {
                state.credito = credito;
            },
            setToListaVehiculos(state, vehiculo) {
                state.listaVehiculos.push(vehiculo);
            },
            resetListaVehiculos(state) {
                state.listaVehiculos = [];
            }
        },
        actions: {
            async onSubmit({state}) {
                let dat = {
                    ventas : state.ventas,
                    solicitud : state.solicitud,
                    credito : state.credito
                }

                let url = '';

                if (state.data.status == 'create') {
                    url = '/api/creditosV3/store';
                } else {
                    url = '/api/creditosV3/update';
                }

                let res = await axios.post(url, dat);
            },
            noContinuarASolicitud(context) {
                context.commit('setContinuarASolicitud', false);
            }
        }
    })
</script>