
@section('title','Creditos morosos')
@section('encabezado','Callcenter créditos en mora <i class="fas fa-ban"></i>')

@section('contenido')
    <!--
    ** VISTA ENCARGADA DE MOSTRAR EL LISTADO DE LOS CLIENTES JUNTO A UNA BARRA DE BUSQUEDA Y LA
    ** OPCION DE ORDENAMIENTO
    **
    -->

    @include('start.callcenter.content_list_call')

@endsection
@include('templates.main2')
