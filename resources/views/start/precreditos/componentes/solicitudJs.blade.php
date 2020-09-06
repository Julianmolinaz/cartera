<script src="/js/rules/solicitud.js"></script>
<script src="/js/interfaces/solicitud.js"></script>
<script>

    const solicitud = Vue.component('solicitud-component',{
        template: '#solicitud-template',
        data() {
            return {
                rango1: [],
                rango2: [],
                data: this.$store.state.data,
                solicitud: this.$store.state.solicitud,
                rules: rules_solicitud
            }
        },
        methods: {
            volver () {
                $('.nav-tabs a[href="#producto"]').tab('show');
            },
            continuar () {
                $('.nav-tabs a[href="#credito"]').tab('show') 
            },
            async onSubmit() {

                if ( ! await this.$validator.validate() ) {
                    alert('Por favor complete los campos');
                    return false;
                }
                
                this.solicitud.ref_productos = this.$store.state.elements;
                this.solicitud.producto_id = this.$store.state.producto_id;
                this.$store.commit('setSolicitud', this.solicitud);

                if (this.$store.state.data.status == 'create') {
                    await this.save();
                } else {
                    await this.update();
                }                
            }, 
            async save() {
                
                let res = await axios.post('/start/precreditos', this.solicitud)

                alertify.notify(res.data.message, 'success', 5);

                if (!res.data.error) {
                    window.location.href = "{{url('/start/clientes')}}/"+res.data.dat;
                }
            },
            async update() {
                await this.$store.dispatch('update');
            },                       
            async validarForm() {
                let valid = await this.$validator.validate();
                return valid
            },
            validar_negocio() {

                if (this.solicitud.vlr_fin &&
                    this.solicitud.cuotas  &&
                    this.solicitud.vlr_cuota ) {

                    const sumatoria = this.solicitud.cuotas *  this.solicitud.vlr_cuota;

                    if ( sumatoria <= (this.solicitud.vlr_fin * 1)) {
                        // alertify.notify('La sumatoria de cuotas no coincide con el valor del centro de costos', 'error', 5)
                    } else {
                        alertify.notify('El resultado es válido', 'success', 10)
                    }
                }
            },
            async setup(){

                if (this.solicitud.meses && this.solicitud.periodo) {
                    rock = (this.solicitud.periodo == 'Quincenal') ? 2 : 1;  
                    this.solicitud.cuotas = parseInt(this.solicitud.meses) * parseInt(rock);
                }

                if ( this.solicitud.periodo == 'Quincenal' ) {
                    this.rango1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
                } else {
                    this.rango2 = [];
                    this.rango1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                }

                if (this.solicitud.p_fecha) await this.setRango2()
            },
            setRango2(){
            
                if (this.solicitud.periodo === 'Quincenal') {

                    var n = parseInt(this.solicitud.p_fecha);
                    var arr = [];

                    for (let i = 0; i < 3; i++) {
                        if (n+(15 + i) <= 30) arr.push(n + (15 + i));
                    }

                    this.rango2 = arr;

                    // alertify.notify('Escoja una segunda fecha', 'success', 5);
                } else {
                    this.rango2 = []
                }
            }
        
        },   
        async created() {
            console.log(this.$store.state.data.cliente.id)

            if (this.$store.state.data.status == 'create') {
                this.solicitud.cliente_id = this.$store.state.data.cliente.id
            } 
            else if (this.$store.state.data.status == 'edit') {

                await this.setup();
            }
        }
    });

</script>

