@section('title','callcenter agendados')
@section('encabezado','Callcenter agendados <i class="fas fa-bell"></i>')

@section('contenido')
    <!--
    ** VISTA ENCARGADA DE MOSTRAR EL LISTADO DE LOS CLIENTES JUNTO A UNA BARRA DE BUSQUEDA Y LA
    ** OPCION DE ORDENAMIENTO
    **
    -->

    <!-- html de la lista -->

    @include('start.callcenter.content_list_call')

@endsection
@include('templates.main2')
