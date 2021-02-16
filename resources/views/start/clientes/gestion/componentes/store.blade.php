
<script src="/js/vue/vuex.js"></script>

<script>

     const store = new Vuex.Store({
        state: {
            estado          : {!! json_encode($estado) !!},
            cliente_id      : {!! json_encode($cliente_id) !!},
            cliente         : new Cliente(),
            info_personal   : new InfoPersonal(),
            info_ubicacion  : new InfoUbicacion(),
            info_economica  : new InfoEconomica(),
            conyuge         : new Conyuge(),
            municipios      : {!! json_encode($municipios) !!},
            data            : {!! json_encode($data) !!}
        },
        getters: {
            getCliente: (state) => {
                return state.cliente
            },
            getOficios: (state) => {
                return state.data.oficios
            },
            getMunicipios: (state,value) => {
                var value_ = value.toLowerCase
                
                return state.municipios.filter( municipio => {
                    municipio.nombre.toLowerCase().includes(value_)
                })
            }
        },
        mutations: {
            setGeneralInfoCliente (state, general) {
                state.cliente.id = general.id
                state.cliente.calificacion = general.calificacion
            },
            setCliente (state, cliente) {
                state.cliente = cliente
            },
            setPersonal (state,info_personal) {
                state.info_personal = info_personal
                state.cliente.info_personal = info_personal
            },
            setUbicacion (state, info_ubicacion) {
                state.info_ubicacion = info_ubicacion
                state.cliente.info_ubicacion = info_ubicacion
            },
            setEconomica (state,info_economica) {
                state.info_economica = info_economica
                state.cliente.info_economica = info_economica
            },
            setClienteId (state, cliente_id) {
                state.cliente.id = cliente_id
            },
            setConyuge (state, conyuge) {
                state.conyuge = conyuge
            },
            setOficios (state, oficios) {
                state.data.oficios = oficios
            },
            setTipo (state, tipo) {
                state.cliente.tipo = tipo
            }
        },
        actions: {
            async update ({state,getters}) {

                if ( state.cliente.tipo == 'cliente' ) {
                    route = '/start/clientes/updateV2';
                    res = await axios.post(route, state.cliente);
                    console.log(res);
                    if (res.data.success) {
                        alertify.notify(res.data.message, 'success', 2, () => {
                            document.location.href= "/start/clientes/"+res.data.dat 
                        });
                    } else {
                        alertify.alert('Error =(', res.data.message);
                    }
                } 
                else if (state.cliente.tipo == 'codeudor') {
                    route = '/start/codeudores/updateV2/' + state.cliente_id;
                    res = await axios.put(route, state.cliente);

                    console.log(res);


                    if (res.data.success) {
                        alertify.notify(res.data.message, 'success', 2, () => {
                            document.location.href= "/start/clientes/"+res.data.dat 
                        });
                    } else {
                        alertify.alert('Error =(', res.data.message);
                    }
                }
            }
        }
    })
</script>