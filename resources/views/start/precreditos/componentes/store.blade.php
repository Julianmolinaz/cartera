<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            data: {!! json_encode($data) !!},
            solicitud: {!! json_encode($solicitud) !!} || new Solicitud(),
            productos: {!! json_encode($data['productos']) !!},
            producto_id: {!! json_encode($producto_id) !!},
            producto: {},
            elements: {!! json_encode($elements) !!}
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
            setProducto(state, producto){
                state.producto = producto;
            },
            setElements(state, elements){
                state.elements = elements
            },
            setSolicitud(state, solicitud){
                state.solicitud = solicitud
            },
            setProductoId(state, producto_id){
                state.solicitud.producto_id = producto_id
            },
            setProductId(state, producto_id) {
                state.producto_id = producto_id
            }
        },
        actions: {
            async update({state,getters}){

                let res = await axios.post('/start/precreditos/updateV2', state.solicitud);

                console.log({res});

                alertify.set('notifier','position', 'top-right');
                
                if (!res.data.error) {
                    alertify.notify(res.data.message, 'success', 3, () => {
                        window.location.href = "{{url('/start/clientes')}}/"+res.data.dat;
                    });
                } else {
                    alertify.notify(res.data.message, 'error', 5, function() {console.log(res.data.message)});
                }
            }
        }
    })
</script>