
<!-- *** tabla informativa reporte ***-->

<div id="tbl_report">
    <div class="panel panel-default" v-if="puntos">
        <div class="panel-body">

        <table class="table table-striped" id="table" >

            <tr v-for="punto in puntos" class="tbl_min" v-if="punto.carteraTotal$ > 0 || punto.castigada.cartera$ > 0">
                <th v-text="punto.punto"></th>
                <td>
                    <span class="resaltar">Al dia</span><br>
                    <span>$: @{{ punto.alDia.cartera$ | miles }}</span><br>
                    <span v-text="'#: '+punto.alDia.carteraNo"></span><br>
                    <span v-text="'%: '+punto.alDia.indicador"></span>
                </td>
                <td>
                    <span class="resaltar">Ideal</span><br>
                    <span>$: @{{ punto.ideal.cartera$ | miles }}</span><br>
                    <span v-text="'#: '+punto.ideal.carteraNo"></span><br>
                    <span v-text="'%: '+punto.ideal.indicador"></span>
                </td>
                <td>
                    <span class="resaltar">Alerta</span><br>
                    <span>$: @{{ punto.alerta.cartera$ | miles }}</span><br>
                    <span v-text="'#: '+punto.alerta.carteraNo"></span><br>
                    <span v-text="'%: '+punto.alerta.indicador"></span>
                </td>
                <td>
                    <span class="resaltar">Critica</span><br>
                    <span>$: @{{ punto.critica.cartera$ | miles }}</span><br>
                    <span v-text="'#: '+punto.critica.carteraNo"></span><br>
                    <span v-text="'%: '+punto.critica.indicador"></span>
                </td>      
                <td>
                    <span class="resaltar">Prejurídico</span><br>
                    <span>$: @{{ punto.prejuridico.cartera$ | miles }}</span><br>
                    <span v-text="'#: '+punto.prejuridico.carteraNo"></span><br>
                    <span v-text="'%: '+punto.prejuridico.indicador"></span>
                </td>      
                <td>
                    <span class="resaltar">Castigada</span><br>
                    <span>$: @{{ punto.castigada.cartera$ | miles }}</span><br>
                    <span v-text="'#: '+punto.castigada.carteraNo"></span><br>
                    <span v-text="'%: '+punto.castigada.indicador"></span>
                </td>   
                <td style="background: #fec300;">    
                    <span class="resaltar">Total</span><br>
                    <span>$: @{{ punto.carteraTotal$ | miles }}</span><br>
                    <span v-text="'#: '+punto.carteraTotalNo"></span><br>
                    <span></span>
                </td>                                                             
            </tr>


        </table>
        </div>
    </div>

</div>

<script>
    var tbl_report = new Vue({
        el : '#tbl_report',
        data: {
            puntos : ''
        },
        methods:{
            getReport(cartera_id){
                var self = this
                axios.get('/admin/gestion_cartera/getCartera/'+ cartera_id)
                    .then(function(res){
                        console.log('report: ',res)
                        if(res.data.error){
                            alert(res.data.message)
                        }
                        else{
                            self.puntos = res.data.dat
                        }
                    })
            }
        },
        filters: {
            miles(numero) {
                var str = numero.toString();
                var resultado = "";
		return new Intl.NumberFormat("es-Co").format(numero);
            }  
        },
        created(){

            var self = this

            Bus.$on('getReport',function(cartera){
                self.getReport(cartera.id)
            })
        }
    })

</script>
