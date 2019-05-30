@section('title','carteras')

@section('contenido')

<div class="row" id="principal">

    <div class="col-md-12" id="tbl_report">

        <a href="{{route('admin.gestion_cartera.index')}}" class="btn btn-default" role="button">Volver</a></p>
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

</div>



<!-- *** tabla informativa reporte ***-->

<script>
    var tbl_report = new Vue({
        el : '#tbl_report',
        data: {
            puntos : {!! json_encode($report) !!}
        },
        methods:{
            getReport(){
                var self = this
                axios.get('/admin/gestion_cartera/get_info_puntos')
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
                // Ponemos un punto cada 3 caracteres
                for (var j, i = str.length - 1, j = 0; i >= 0; i--, j++)
                    resultado = str.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + resultado;
                return resultado;
            }  
        },
        created(){

        }
    })

</script>


@endsection

@include('templates.main2')