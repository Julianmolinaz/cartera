<script src="/js/vue/vuex.js"></script>

<script>
    const store = new Vuex.Store({
        state: {
            data            : {!! json_encode($data) !!},
            solicitud       : {!! json_encode($solicitud) !!} || new Solicitud(),
            productos       : {!! json_encode($data['productos']) !!},
            producto        : {!! json_encode($producto) !!}, 
            producto_id     : {!! json_encode($producto_id) !!},
            ref_productos   : {!! json_encode($ref_productos) !!},
            data_credito    : {!! json_encode($data_credito) !!},
            credito         : {!! json_encode($credito) !!},
            data_credito    : {!! json_encode($data_credito) !!},
            fecha_pago      : {!! json_encode($fecha_pago) !!},
            message         : ''
        },
        getters: {
            getProductos(state) {
                return state.productos
            }, 
            getProducto(state) {
                return state.producto
            },
            getData(state) {
                return {
                    solicitud : state.solicitud,
                    credito   : state.credito,
                    producto  : state.producto,
                    ref_productos : state.ref_productos,
                    fecha_pago : state.fecha_pago 
                }
            }
        },
        mutations: {
            setProducto(state, producto) {
                state.producto = producto;
            },
            setRefProductos(state, ref_productos) {
                state.ref_productos = ref_productos
            },
            setSolicitud(state, solicitud) {
                state.solicitud = solicitud
            },
            setProductoIdToSolicitud(state) {
                state.solicitud.producto_id = state.producto_id
            },
            setProductoId(state, producto_id) {
                state.producto_id = producto_id
                state.solicitud.producto_id = producto_id
            },
            setCredito(state, credito) {
                state.credito = credito
            },
            setFechaPago(state, fecha_pago) {
                state.fecha_pago = fecha_pago
            }
        },
        actions: {
            async createSolicitud({state,getters}) 
            {
                let dat = {
                    ref_productos : state.ref_productos,
                    solicitud     : state.solicitud,
                    producto      : state.producto
                };

                let res = await axios.post('/start/precreditos', dat);

                alertify.set('notifier','position', 'top-right');

                console.log(res);
                
                if (res.data.success) {
                    alertify.notify(res.data.message, 'success', 2, () => {
                        // window.location.href = "{{url('/start/precreditos')}}/"+res.data.dat.id+'/ver';
                    });
                } else {
                    if (res.data.dat == 'validation') {
                        alertify.alert('Error de validación =(', 'Revise los campos requeridos en el mensaje');
                        var $temp = '';

                        for(var j = 0; j < res.data.message.length; j++) {
                            for(var key in res.data.message[j]) {
                                $temp += res.data.message[j][key][0] + '<br>';
                            }
                        }
                        state.message = $temp;
                    } else {
                        alertify.alert('Error =(', res.data.message);
                    }
                }
            },
            async updateSolicitud({state,getters}) 
            {
                let dat = {
                    ref_productos : state.ref_productos,
                    solicitud     : state.solicitud,
                    producto      : state.producto
                };

                let res = await axios.post('/start/precreditos/updateV2', dat);

                alertify.set('notifier','position', 'top-right');

                console.log(res);
                
                if (res.data.success) {
                    alertify.notify(res.data.message, 'success', 2, () => {
                        // window.location.href = "{{url('/start/precreditos')}}/"+res.data.dat.id+'/ver';
                    });
                } else {
                    if (res.data.dat == 'validation') {
                        alertify.alert('Error de validación =(', 'Revise los campos requeridos en el mensaje');
                        var $temp = '';

                        for(var j = 0; j < res.data.message.length; j++) {
                            for(var key in res.data.message[j]) {
                                $temp += res.data.message[j][key][0] + '<br>';
                            }
                        }
                        state.message = $temp;
                    } else {
                        alertify.alert('Error =(', res.data.message);
                    }
                }
            },
            async updateCredito({state, getters}) 
            {
                var dat = {
                    ref_productos : state.ref_productos,
                    credito       : state.credito,
                    solicitud     : state.solicitud,
                    fecha_pago    : state.fecha_pago,
                    producto      : state.producto
                }

                let res = await axios.post('/start/creditos/updateV2', this.getters['getData']);

                console.log(res);

                alertify.set('notifier','position', 'top-right');
                
                if (res.data.success) {
                    alertify.notify(res.data.message, 'success', 2, () => {
                        // window.location.href = "{{url('/start/precreditos')}}/"+res.data.dat.precredito_id+'/ver';
                    });
                } else {
                    if (res.data.dat == 'validation') {
                        alertify.alert('Error de validación =(', 'Revise los campos requeridos en el mensaje');
                        var $temp = '';

                        for(var j = 0; j < res.data.message.length; j++) {
                            for(var key in res.data.message[j]) {
                                $temp += res.data.message[j][key][0] + '<br>';
                            }
                        }
                        state.message = $temp;
                    } else {
                        alertify.alert('Error =(', res.data.message);
                    }
                }
            }
        }
    })
</script>