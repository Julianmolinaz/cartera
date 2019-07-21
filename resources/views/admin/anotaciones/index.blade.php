@section('title','multas')

@section('contenido')
<div id="anotaciones">
    <div>
        <div class="col-md-3 col-md-xs-12">
           <proceso-component></proceso-component>
        </div>
        <div class="col-md-5 col-md-xs-12">
            <list-anotaciones v-show="activar"></list-anotaciones>
        </div>
        <div class="col-md-4 col-md-xs-12">
            <anotacion-component v-show="activar"></anotacion-component>
        </div>
    </div>

    @include('admin.anotaciones.anotacion')
    @include('admin.anotaciones.list')
    @include('admin.anotaciones.proceso')

</div>
<script>
    const Bus = new Vue()

    const anotaciones = new Vue({
        el:'#anotaciones',
        data : {
            credito : {!! $credito !!},
            activar : false
        },
        created(){

            var self = this

            Bus.$on('activarAnotaciones', function(){
                self.activar = true
            })
        }
    })

</script>

@endsection
@include('templates.main2')