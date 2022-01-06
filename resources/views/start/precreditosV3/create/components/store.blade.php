<script src="/js/vue/vuex.js"></script>
<script src="{{ asset('js/SolicitudV3/Solicitud.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Credito.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/ProductoVenta.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Venta.js') }}"></script>

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
            ventas              : [], // listado de ventas agregadas a las solicitud venta: { producto: .., vehiculo: ... }
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
            }
        },
        actions: {
            agregarVenta({state}, payload) {
                if (!payload.producto || !payload.cantidad) {
                    alertify.alert("Atención", "Se requiere escoger un producto y su cantidad");
                    return;
                }

                for (let i = 0; i < payload.cantidad; i++) {
                    let venta = new Venta({});

                    venta.producto = new ProductoVenta({
                        nombre: payload.producto.nombre,
                        producto_id: payload.producto.id,
                        con_vehiculo: payload.producto.con_vehiculo,
                        cantidad: payload.cantidad,
                    });

                    if (payload.producto.con_vehiculo) venta.vehiculo = new Vehiculo();

                    state.ventas.push(venta);
                }

                alertify.notify("Se agrego el producto.", "success", 1.5);
            },
            eliminarVenta({state}, index) {
                alertify.confirm('Eliminar Producto', '¿Está seguro de eliminar el producto?',
                    () => {
                        state.ventas.splice(index, 1);
                        alertify.notify("Se ha eliminado el producto", "error", 1.5);
                    }, 
                    () => alertify.error('No se elimino ningun producto.', 1.5)
                );
            },
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