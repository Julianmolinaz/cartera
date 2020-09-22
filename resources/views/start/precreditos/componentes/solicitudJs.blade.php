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
                rules: rules_solicitud,
                show : {!! json_encode(\Auth::user()->can('editar_solicitudes')) !!}
            }
        },
        filters: {
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        },
        methods: {
            async volver () {

                if (! await this.validation()) return false; 

                await this.assignData();
                
                $('.nav-tabs a[href="#producto"]').tab('show');
            },
            async continuar () {
                await this.assignData();
                $('.nav-tabs a[href="#credito"]').tab('show') 
            },
            async onSubmit() {

                if (! await this.validation()) return false;
                
                await this.assignData();

                var status = await this.$store.state.data.status;

                console.log({status});

                if (status == 'create') 
                    await this.$store.dispatch('createSolicitud');

                else if (status == 'edit')
                    await this.$store.dispatch('updateSolicitud');

                else if (status == 'edit cred')
                    await this.$store.dispatch('updateCredito');
            }, 
            async assignData() {
                console.log('Assign data');
                await this.$store.commit('setSolicitud', this.solicitud);
            },                     
            async validation() {
                
                if ( ! await this.$validator.validate() ) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Por favor complete los campos', 'error', 5, function(){  });
                    return false;
                }

                return true;
            },
            validar_negocio() {

                if (this.solicitud.vlr_fin && this.solicitud.cuotas && this.solicitud.vlr_cuota ) {

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
                    this.rango1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                }

                if (this.solicitud.p_fecha) await this.setRango2()
            },
            setRango2(){

                this.solicitud.s_fecha = '';
            
                if (this.solicitud.periodo === 'Quincenal') {

                    var n = parseInt(this.solicitud.p_fecha);
                    this.solicitud.s_fecha = n + 15;
                    
                } else {
                    this.rango2 = []
                }
            }
        
        },   
        created() {

            Bus.$on('assign_solicitud', () => {
                console.log('view solicitud');
                this.assignData();
            });

            if (this.$store.state.data.status == 'create') {
                this.solicitud.cliente_id = this.$store.state.data.cliente.id
            } 
            else if (this.$store.state.data.status == 'edit' || this.$store.state.data.status == 'edit cred') {
                this.setup();
            }
        }
    });

</script>

<style scoped>
    .my-input {
        font-size:10px;
    }
</style>

