<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            productos: {!! json_encode($productos) !!},
            producto: 0
        },
        getters: {
            getProductos(state){
                return state.productos
            }, 
            getProducto(state){
                return state.producto
            }
        },
        mutations: {
            setProducto(state, new_producto){
                state.producto = new_producto
            }
        },
        actions: {
            generateVehiculos(context){
                // crear los vehiculos
                // crear las rules
            }
        }
    })
</script>