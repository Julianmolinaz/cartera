<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            data                : {!! json_encode($data) !!},
            insumos             : {!! json_encode($insumos) !!},
            continuarASolicitud : true,
            productos           : '',
            message             : '',
            ventas              : [],
        },
        getters: { 
            getContinuarASolicitud(state) {
                return state.continuarASolicitud;
            }
        },
        mutations: {
            setContinuarASolicitud(state, response) {
                state.continuarASolicitud = response;
            }
        },
        actions: {
            noContinuarASolicitud(context) {
                context.commit('setContinuarASolicitud', false);
            }
        }
    })
</script>