<script src="/js/vue/vuex.js"></script>
<script src="{{ asset('js/SolicitudV3/Solicitud.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Credito.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/ProductoVenta.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Venta.js') }}"></script>

<script>
    const store = new Vuex.Store({
        state: {
            ventas: {!! json_encode($ventas) !!},
            solicitud: {!! json_encode($solicitud) !!},
            insumos: {!! json_encode($insumos) !!},
        },
        getters: { 
          
        },
        mutations: {
          
        },
        actions: {
          
        }
    });

    const showErrorValidation = (strMessage) => {
        let strErrors = "";
        JSON.parse(strMessage).forEach(error => strErrors += error + "<br>" );
        return strErrors;
    }
</script>