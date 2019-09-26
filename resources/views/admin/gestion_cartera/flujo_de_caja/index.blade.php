@section('title','carteras') @section('contenido')


<div class="container" id="flujo-template">
    <flujo-component></flujo-component>
</div>

<script type="text/x-template" id="template">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Flujo de Caja</h3>
        </div>
        <div class="panel-body">

            <div class="col-md-4 col-xs-12">
                <div class="for-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Fecha inicial</label>
                            <input type="date" class="form-control" v-model="fecha_inicial">
                            <small class="help-block">Seleccione la fecha inicial calcular el recaudo.</small>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha final</label>
                            <input type="date" class="form-control" v-model="fecha_final">
                            <small class="help-block">Seleccione la fecha final calcular el recaudo.</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Negocios</label>
                    <select class="form-control" @change="selectedCarteras()" v-model="carteras_negocio">
                        <option disabled selected>- -</option>
                        <option :value="negocio.carteras" v-for="negocio in negocios">@{{negocio.nombre}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Carteras</label>
                    <br>
                    <label>
                        <input type="checkbox" @click="checkedAll()">
                            Seleccionar todo
                        </label>
                    <ul>
                        <li v-for="cartera in carteras" style="list-style:none;">
                            <label>
                                <input type="checkbox" :value="cartera.checked" :checked="cartera.checked">
                                @{{cartera.nombre}}
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8 col-xs-12">
                <div class="form-group">

                    <button class="btn btn-danger btn-block" @click="submit()">Consultar Flujo de Caja</button>

                </div>
                <center v-if="recaudo.minimo">
                    <h1>Recaudo Mínimo : $@{{ recaudo.minimo | miles}}</h1>
                    <small class="help-block">∑ recaudo de cuotas créditos Al día.</small>
                    <h1>Recaudo Medio : $@{{ recaudo.minimo + recaudo.medio | miles}}</h1>
                    <small class="help-block">∑ recaudo de cuotas créditos Al dia y Mora.</small>
                    <h1>Recaudo Máximo : $@{{ recaudo.maximo + recaudo.medio + recaudo.minimo | miles}}</h1>
                    <small class="help-block">∑ recaudo decuotas créditos Al dia, Mora, Prejurídico y Jurídico</small>
                    <h1>Sanciones : $@{{ recaudo.sanciones | miles }}</h1>
                    <small class="help-block">∑ recaudo sanciones</small>
                </center>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('flujo-component', {
        template: '#template',
        data() {
            return {
                carteras:  [],
                carteras_negocio: [],
                negocios: [],
                checked: false,
                fecha_inicial: '',
                fecha_final: '',
                recaudo: []
            }
        },
        methods: {
            submit() {
                var self = this

                if (!this.fecha) {
                    alert('Se requiere la fecha');
                    return false;
                }

                axios.post('/admin/gestion_cartera/get_flujo_de_caja', {
                    carteras: this.carteras,
                    fecha_inicial: this.fecha_inicial,
                    fecha_final: this.fecha_final
                }).then(res => {
                    console.log(res.data.dat);

                    if (res.data.success) {
                        self.recaudo = res.data.dat
                    } else {
                        alert(res.data.message)
                    }
                })
            },
            getData() {
                var self = this
                axios.get('/admin/gestion_cartera/data_flujo_de_caja')
                    .then(res => {
                        if (res.data.success) {
                            self.carteras = res.data.dat.carteras
                            self.negocios = res.data.dat.negocios
                        }
                    });
            },
            selectedCarteras() {
                var self = this
                this.carteras.forEach(cartera => {
                    cartera.checked = false
                    self.carteras_negocio.forEach(cartera_negocio => {
                        if (cartera.id == cartera_negocio.id) {
                            cartera.checked = true
                        }
                    });
                })
            },
            checkedAll() {
                var self = this
                this.checked = !this.checked
                this.carteras.forEach(cartera => {
                    cartera.checked = self.checked
                })
            }
        },
        filters: {
            miles(numero) {
                var str = numero.toString();
                var resultado = "";
                // Ponemos un punto cada 3 caracteres
                for (var j, i = str.length - 1, j = 0; i >= 0; i--, j++)
                    resultado = str.charAt(i) + ((j > 0) && (j % 3 == 0) ? "." : "") + resultado;
                return resultado;
            }
        },
        created() {
            this.getData();
        }
    })
</script>

<script>
    new Vue({
        el: '#flujo-template'
    });
</script>


@endsection @include('templates.main2')