<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            solicitud       : '',
            credito         : '',
            productos       : '',
            catalogo        : {!! json_encode($catalogo) !!},
            insumosSolicitud: '',
            insumosProducto : '',
            insumosCredito  : '',
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