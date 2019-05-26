<div id="info">

    <div class="form-group">
        <label for="">Cartera</label>
        <select name="" id="" class="form-control" v-model="cartera">
            <option disabled selected>- -</option>
            <option :value="cartera" v-for="cartera in carteras">@{{ cartera.nombre }}</option>
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-sm btn-primary" @click="generar">Generar</button>
    </div>

</div>

<script>

    var Bus = new Vue()

    var info = new Vue({
        el : '#info',
        data : {
            carteras : '',
            cartera  : ''
        },
        methods : {
            getCarteras(){
                var self = this
                axios.get('/admin/gestion_cartera/getCarteras')
                    .then(function(res){
                        self.carteras = res.data.dat
                    })
            },
            generar(){
                Bus.$emit('getReport',this.cartera)
            }
        },
        created(){
            this.getCarteras()
        }
    })
</script>