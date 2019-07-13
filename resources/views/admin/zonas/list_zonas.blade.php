<script type="text/x-template" id="list_zonas-template">

    <div class="list-group">
        <div class="list-group-item active">
            Zonas Gora
        </div>

        <a href="#" class="list-group-item" 
           v-for="zona in zonas">@{{ zona.nombre }}</a>
    </div>

</script>
<script>

    Vue.component('list_zonas-template',{
        template: "#list_zonas-template",
        data(){
            return {
                zonas : []
            }
        },
        methods : {
            getZonas(){
                var self = this
                axios.get('/admin/getZonas')
                    .then( res => {
                        if(res.data.error){
                            alert(res.data.message)
                        } else {
                            console.log({res});
                            
                            self.zonas = res.data.dat
                        }
                    })
            }
        },
        created(){
            var self = this

            this.getZonas()
            Bus.$on('getZonas', () => {
                self.getZonas()
            })
        }
    })

</script>