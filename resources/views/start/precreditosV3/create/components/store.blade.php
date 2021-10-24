<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            data            : '',
            catalogo        : {!! json_encode($catalogo) !!},
            insumosInvoice  : {!! json_encode($insumosInvoice) !!},
            insumosVehiculo : {!! json_encode($insumosVehiculo) !!},
            productos       : '',
            credito         : '',
            message         : ''
        },
        getters: { 

        },
        mutations: {

        },
        actions: {

        }
    })
</script>