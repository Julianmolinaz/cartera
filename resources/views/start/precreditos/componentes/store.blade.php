<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            data: {!! json_encode($data) !!},
            solicitud: new Solicitud(),
            productos: {!! json_encode($data['productos']) !!},
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
            },
            setProductosToSolicitud(state, productos){
                console.log('store',productos)
                state.solicitud.productos = productos
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