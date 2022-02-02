@include('utils.general')

<script src="/js/vue/vuex.js"></script>
<script src="{{ asset('js/SolicitudV3/Solicitud.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Credito.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/ProductoVenta.js') }}"></script>
<script src="{{ asset('js/SolicitudV3/Venta.js') }}"></script>

<script>
    const store = new Vuex.Store({
        state: {
            modo                : {!! json_encode($modo) !!},
            data                : {!! json_encode($data) !!}, // Insumos solicitud
            insumos             : {!! json_encode($insumos) !!}, // Insumos Venta
            insumosCredito      : {!! json_encode($insumos_credito) !!}, 
            continuarASolicitud : true,
            permitirSalvar      : true,
            solicitud           : {!! json_encode($solicitud) !!} || new Solicitud({
                cliente_id: {!! $cliente->id !!},
                aprobado: "En estudio",
                fecha: new Date(Date.now()).toISOString().slice(0, 10)
            }),
            credito             : {!! json_encode($credito) !!} || null,
            ventas              : {!! json_encode($ventas) !!} || [], // listado de ventas agregadas a las solicitud venta: { producto: .., vehiculo: ... }
            vehiculos           : [], // listado de vehiculos a clonar
            cliente             : {!! json_encode($cliente) !!},
            permisos            : {
                'aprobarSolicitud' :  {!! json_encode(Auth::user()->can('aprobar_solicitudes')) !!}
            }
        },
        getters: { 
            getContinuarASolicitud(state) {
                return state.continuarASolicitud;
            },
            getPermitirSalvar(state) {
                return state.permitirSalvar;
            },
            getVehiculosAClonar(state) {
                return state.vehiculos;
            },
            getRutaSalida(state) {
                let rutaSalid = '';

                if (state.modo !== 'Crear Solicitud') {
                    rutaSalida = '/start/precreditosV3/show/' + state.solicitud.id;
                } else {
                    rutaSalida = '/start/clientes/' + state.cliente.id;
                }

                return rutaSalida;
            }
        },
        mutations: {
            setContinuarASolicitud(state, response) {
                state.continuarASolicitud = response;
            },
            setPermitirSalvar(state, response) {
                state.permitirSalvar = response;
            },
            setVentas(state, ventas) {
                state.ventas = ventas;
            },
            setSolicitud(state, solicitud) {
                state.solicitud = solicitud;
            },
            setCreditos(state, credito) {
                state.credito = credito;
            },
            setVehiculoAClonar(state, vehiculo) {
                state.vehiculos.push(vehiculo);
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
                        if (state.modo === 'Crear Solicitud') {
                            state.ventas.splice(index, 1);
                            alertify.notify("Se ha eliminado el producto", "error", 1.5);
                        } else {
                            axios.get("/api/ventas/destroy/" + state.ventas[index]['id'])
                                .then(res => {
                                    state.ventas.splice(index, 1);
                                    alertify.alert("Alerta", res.data.message)
                                })
                        }
                    }, 
                    () => alertify.error('No se elimino ningun producto.', 1.5)
                );
            },
            listarVehiculosAClonar({state, commit}) {
                state.vehiculos = [];
                state.ventas.map(venta => {
                    if (venta.vehiculo && venta.vehiculo.placa) {
                        if (!state.vehiculos.find(vehiculo => vehiculo.placa === venta.vehiculo.placa)) {
                            commit("setVehiculoAClonar", venta.vehiculo);
                        }
                    }
                });
            },
            clonarVehiculo({state, commit}, payload) {
                delete payload.vehiculo.id;
                state.ventas[payload.index].vehiculo = JSON.parse(JSON.stringify(payload.vehiculo));
            },
            async onSubmit({state}) {
                let url = '';
                const dat = {
                    ventas : state.ventas,
                    solicitud : state.solicitud,
                    credito : state.credito
                }

                if (state.modo == 'Crear Solicitud') url = '/api/precreditosV3';
                else if (state.modo == 'Editar Solicitud') url = '/api/precreditosV3/update';
                else if (state.modo == 'Editar Credito') url = '/api/creditosV3/update';
                else if (state.modo == 'Refinanciar Credito') 
                    url = '/api/refinanciacion/' + state.insumosCredito.credito_refinanciado_id;

                try {
                    const res = await axios.post(url, dat);

                    if (res.data.success) {
                        alertify.notify(res.data.message, "success", 2, () => {
                            window.location.href = "{{ url('start/precreditosV3/show') }}/" + res.data.dat.id;
                        });
                    } else {
                        if (res.data.dat === 1) {
                            alertify.alert("Error en validación", showErrorValidation(res.data.message));
                        } else {
                            alertify.alert("Ha ocurrido un error", res.data.message);
                        }
                    }
                } catch (error) {
                    alertify.alert("Ha ocurrido un error", error.message);
                }
            },
            noContinuarASolicitud(context) {
                context.commit('setContinuarASolicitud', false);
            },
            noPermitirSalvar(context) {
                context.commit('setPermitirSalvar', false);
            },
        }
    });
</script>