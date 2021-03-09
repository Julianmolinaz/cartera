<script src="/js/interfaces/producto.js"></script>
<script src="/js/rules/producto.js"></script>
<script src="/js/productos/logica.js"></script>

<script>

    const producto = Vue.component('producto-component',{
        template: '#producto-template',
        data() {
            return {
                producto_id : this.$store.state.producto_id,
                rules       : rules_producto,
                productos   : this.$store.state.productos,
                ref_productos : this.$store.state.ref_productos,
                producto    : '',
                show : {!! json_encode(\Auth::user()->can('editar_producto_solicitudes')) !!}
            }
        },
        filters: {
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        },
        methods: {
            async cargarProducto() {
		
                this.producto = await this.productos.find(producto => producto.id ==  this.producto_id);
                await this.$store.commit('setProductoId', this.producto.id);
                await this.$store.commit('setProducto',this.producto);
		
                this.ref_productos = await getProductos(this.producto);
            },
	    vencimiento(index) {
		const nombre = this.ref_productos[index].nombre;

		console.log({nombre});
                let fecha = this.ref_productos[index].fecha_exp;
                console.log({fecha});

                if (nombre == 'SOAT') {
                    console.log('entro por soat');
                    this.ref_productos[index]._vencimiento_soat = this.addYear(fecha)
                    
                } else if (nombre == 'R.T.M') {
                    console.log('entro por rtm');
                    this.ref_productos[index]._vencimiento_rtm = this.addYear(fecha)
                }   
	    },
	    addYear(fecha) {
                // fecha con año + 1
                if (fecha) {
                    return moment(fecha).add(1, 'years').format('YYYY-MM-DD');
                } else {
                    console.log(': ',fecha_);
                    return fecha;
                }
            },
            check(index) {

                let check = document.getElementById('check'+index).value

                this.resetVehiculo(index)

                if (!check || check == 'false') {
                    document.getElementById('check'+index).value = true
                    this.asignarVehiculo(index)
                } else {
                    document.getElementById('check'+index).value = false
                }

            },
            asignarVehiculo(index) {
                this.ref_productos[index]._placa = this.ref_productos[index - 1 ]._placa
                this.ref_productos[index]._tipo_vehiculo_id = this.ref_productos[index - 1 ]._tipo_vehiculo_id
                this.ref_productos[index]._vencimiento_soat = this.ref_productos[index - 1 ]._vencimiento_soat
                this.ref_productos[index]._vencimiento_rtm  = this.ref_productos[index - 1 ]._vencimiento_rtm
            },
            resetVehiculo(index) {
                this.ref_productos[index]._placa             = '';
                this.ref_productos[index]._tipo_vehiculo_id  = '';
                this.ref_productos[index]._vencimiento_soat  = '';
                this.ref_productos[index]._vencimiento_rtm   = '';
            },
            async continuar() {
                if (! await this.validate()) return false;

                await this.assignData();

                $('.nav-tabs a[href="#solicitud"]').tab('show');
            },
            async update() {

                if (! await this.validate()) return false;

                await this.assignData();

                if (this.$store.state.data.status == 'edit')
                    await this.$store.dispatch('updateSolicitud');

                else if (this.$store.state.data.status == 'edit cred')
                    await this.$store.dispatch('updateCredito');

            },
            assignData() {
                
                this.$store.commit('setRefProductos',this.ref_productos);
            },
            async validate() {

                var count = 0;

                for (var i = 0; i < this.ref_productos.length; i++) {

                    if (!this.validateProveedor(i) ) count ++
                    if (!this.validateTipoVehiculo(i) ) count ++
                }

                let valid = await this.$validator.validate()

                if (!valid || count > 0) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Por favor complete los campos (Producto)', 'error', 5, function(){ });

                    return false
                }
                else return true
            },
            validateProveedor(index) {

                if (!this.ref_productos[index].proveedor_id) {
                    document.getElementById('div-proveedor'+index).classList.add('has-error')
                    document.getElementById('span-proveedor'+index).textContent = 'El proveedor es requerido'
                    return false;
                } else {
                    document.getElementById('div-proveedor'+index).classList.remove('has-error')
                    document.getElementById('span-proveedor'+index).textContent = ''
                    return true;
                }
            },
            validateTipoVehiculo(index) {

                if (!this.ref_productos[index]._tipo_vehiculo_id) {
                    document.getElementById('div-tipo_vehiculo_id'+index).classList.add('has-error')
                    document.getElementById('span-tipo_vehiculo_id'+index).textContent = 'El tipo de vehículo es requerido'
                    return false;
                } else {
                    document.getElementById('div-tipo_vehiculo_id'+index).classList.remove('has-error')
                    document.getElementById('span-tipo_vehiculo_id'+index).textContent = ''
                    return true;
                }
            }
        },
        created(){
            Bus.$on('assign_producto', () => {
                this.assignData();
            });

            if (this.$store.state.status == 'edit_cred') {
                console.log('edit_cred');
                this.rules.fecha_exp.rule = 'required',
                this.rules.fecha_exp.required = '*';
            }
        }
    });

</script>
<style scoped>

    .help-block{
        font-size: 12px;
    }

</style>
