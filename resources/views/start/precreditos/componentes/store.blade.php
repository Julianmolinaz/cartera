<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            productos: {!! json_encode($productos) !!},
            num_vehiculos: 0
        },
        getters: {
            getProductos(state){
                return state.productos
            }
        },
        mutations: {
            setNumVehiculos(state, num){
                state.num_vehiculos = num
            }
        },
        actions: {

        }
    })
</script>