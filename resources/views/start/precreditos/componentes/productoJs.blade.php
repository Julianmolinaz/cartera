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
                elements    : this.$store.state.elements
            }
        },
        methods: {
            cargarProducto() {

                let producto = this.productos.find(producto => producto.id ==  this.producto_id);

                this.elements = getProductos(producto)
                
                this.$store.commit('setProducto',this.producto)
                let min_vehiculos = this.producto.min_vehiculos
                let vehiculos = []
                
                for (var i = 0; i < min_vehiculos; i++) {
                    let vehiculo = new Vehiculo()
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
                if (!await this.validate()) return false;
                await this.$store.commit('setElements',this.elements);
                $('.nav-tabs a[href="#solicitud"]').tab('show');
            },
            save() {},
            async validate() {

                var count = 0;

                for (var i = 0; i < this.elements.length; i++) {

                    if (!this.validateProveedor(i) ) count ++
                    if (!this.validateTipoVehiculo(i) ) count ++
                }

                let valid = await this.$validator.validate()

                if (!valid || count > 0) {
                    alert('Por favor complete los campos');

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
