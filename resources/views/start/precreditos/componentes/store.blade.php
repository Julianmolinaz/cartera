<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            data: {!! json_encode($data) !!},
            solicitud: new Solicitud(),
            productos: {!! json_encode($data['productos']) !!},
            producto: 0,
            elements: []
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
            setElements(state, elements){
                state.elements = elements
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