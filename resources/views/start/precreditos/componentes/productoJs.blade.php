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
                elements    : this.$store.state.elements,
                producto    : ''
            }
        },
        methods: {
            async cargarProducto() {

                this.producto = await this.productos.find(producto => producto.id ==  this.producto_id);
                this.elements = await getProductos(this.producto);
            
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
                this.elements[index]._placa = this.elements[index - 1 ]._placa
                this.elements[index]._tipo_vehiculo_id = this.elements[index - 1 ]._tipo_vehiculo_id
                this.elements[index]._vencimiento_soat = this.elements[index - 1 ]._vencimiento_soat
                this.elements[index]._vencimiento_rtm  = this.elements[index - 1 ]._vencimiento_rtm
            },
            resetVehiculo(index) {
                this.elements[index]._placa             = ''
                this.elements[index]._tipo_vehiculo_id  = ''
                this.elements[index]._vencimiento_soat  = ''
                this.elements[index]._vencimiento_rtm   = ''
            },
            async continuar() {
                if (! await this.validate()) return false;

                this.$store.commit('setProductoId',this.producto_id);
                this.$store.commit('setProductId',this.producto_id);
                this.$store.commit('setProducto',this.producto);
                this.$store.commit('setElements',this.elements);

                $('.nav-tabs a[href="#solicitud"]').tab('show');
            },
            async update() {

                if (! await this.validate()) return false;

                var solicitud = this.$store.state.solicitud;
                
                this.$store.commit('setElements',this.elements);

                solicitud.ref_productos = this.$store.state.elements;
                solicitud.producto_id = this.$store.state.producto_id;

                await this.$store.commit('setSolicitud', solicitud);

                await this.$store.dispatch('update');

            },
            async validate() {

                var count = 0;

                for (var i = 0; i < this.elements.length; i++) {

                    if (!this.validateProveedor(i) ) count ++
                    if (!this.validateTipoVehiculo(i) ) count ++
                }

                let valid = await this.$validator.validate()

                if (!valid || count > 0) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Por favor complete los campos', 'error', 5, function(){ });

                    return false
                }
                else return true
            },
            validateProveedor(index) {

                if (!this.elements[index].proveedor_id) {
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

                if (!this.elements[index]._tipo_vehiculo_id) {
                    document.getElementById('div-tipo_vehiculo_id'+index).classList.add('has-error')
                    document.getElementById('span-tipo_vehiculo_id'+index).textContent = 'El tipo de vehículo es requerido'
                    return false;
                } else {
                    document.getElementById('div-tipo_vehiculo_id'+index).classList.remove('has-error')
                    document.getElementById('span-tipo_vehiculo_id'+index).textContent = ''
                    return true;
                }
            }
        }
    });

</script>
