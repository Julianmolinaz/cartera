<script>

    Vue.component('actividad_economica-component',{
        template: '#actividad_economica-template',
        data() {
            return {
                estado          : this.$store.state.estado,
                rules           : rules_economica,
                economia        : this.$store.state.info_economica,
                data            : this.$store.state.data,
                danger_message  : false,
                arr_messages    : '',
                oficios         : this.$store.state.data.oficios
            }
        },
        methods: {
            volver () {
                $('.nav-tabs a[href="#ubicacion"]').tab('show') 
            },
            async continuar () {
                this.message = '';
                this.danger_message = false;
                if (this.estado == 'edicion') await this.$store.commit('setEconomica',this.economia);
                $('.nav-tabs a[href="#conyuge"]').tab('show');
            },
            async onSubmit (action) {

                await this.$store.commit('setEconomica',this.economia)

                let valid = await this.$validator.validate()

                if (this.estado == 'creacion' && valid) {
                    this.store(action)
                } 
                else if (this.estado == 'edicion' && valid) {
                    this.$store.dispatch('update')
                } 
                else {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Por favor complete la informacion requeridan (Actividad económica)', 'error', 5, function(){  console.log(''); });
                }
            },
            async store(action) {

                let tipo = this.$store.state.cliente.tipo;

                let route = (tipo == 'cliente') ? '/start/clientes' : '/start/codeudores';
                
                let res = await axios.post(route,{
                    cliente: this.$store.state.cliente,
                    cliente_id: this.$store.state.cliente_id,
                });

                // alert(res.data.message);

                if (res.data.success) {

                    if (action == 'continuar') { 
                        await this.$store.commit('setClienteId',res.data.dat.cliente_id)
                        await this.continuar()
                    } else {  
                        alertify.notify(res.data.message, 'success', 2, () => {   
                            document.location.href= "/start/clientes/"+res.data.dat.ref_cliente
                        });
                    }

                } else {
                    alertify.notify(res.data.message, 'error', 5, function(){  console.log('dismissed'); });

                    this.message = res.data.message
                }
            },
            update() {

            },
            activityAction () {

                this.errors.clear();
                this.$validator.reset()
                this.economia.reset(['tel','fech','desc','doc','t2','cargo']);
                this.rules = rules_economica;

                this.rules.fecha_vinculacion.rule  = 'required';
                this.rules.fecha_vinculacion.required  = '*'; 
                

                if (this.economia.tipo_actividad == 'Dependiente') {
                    
                    this.rules.empresa.rule            = 'required';
                    this.rules.empresa.required        = '*';

                    this.rules.tel_empresa.rule        = 'required';
                    this.rules.tel_empresa.required    = '*';

                    this.rules.dir_empresa.rule        = 'required';
                    this.rules.dir_empresa.required    = '*';

                    this.rules.cargo.rule              = 'required';
                    this.rules.cargo.required          = '*';

                    this.rules.tipo_contrato.rule      = 'required'; 
                    this.rules.tipo_contrato.required  = '*';

                } else if (this.economia.tipo_actividad == 'Independiente'){

                    this.rules.descripcion_actividad.rule     = 'required';
                    this.rules.descripcion_actividad.required = '*';

                    this.rules.empresa.rule            = '';
                    this.rules.empresa.required        = '';

                    this.rules.tel_empresa.rule        = '';
                    this.rules.tel_empresa.required    = '';

                    this.rules.dir_empresa.rule        = '';
                    this.rules.dir_empresa.required    = '';

                    this.rules.cargo.rule              = '';
                    this.rules.cargo.required          = '';

                    this.rules.tipo_contrato.rule      = ''; 
                    this.rules.tipo_contrato.required  = '';
                }
            },//.activityAction
            analizarOficio () {
                Bus.$emit('setOficio')
            }
         }
        
    });

</script>