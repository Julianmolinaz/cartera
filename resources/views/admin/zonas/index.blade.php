@section('title','puntos')

@section('contenido')

    <div class="panel panel-default" id="main">
        <div class="panel-heading">
            <h3 class="panel-title">Zonas</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-3" style="border-right: 1px solid #dddddd ">
                <!-- información -->
                <info-component></info-component>
            </div>
            <div class="col-md-3" style="border-right: 1px solid #dddddd ">
                <br>
                <gestion-zona></gestion-zona>
            </div>
            <div class="col-md-6">
                <list_zonas-template></list_zonas-template>
            </div>
        </div>
    </div>

@include('admin.zonas.panel_info')
@include('admin.zonas.gestion')
@include('admin.zonas.list_zonas')

<script>
    var Bus = new Vue()
    
    var main = new Vue({
        el:"#main"
    })

</script>


@endsection

@include('templates.main2')