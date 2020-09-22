@section('title','Pagos')

@section('contenido')


<div class="container">
  <div class="row_col-md-12">
    <center>
      <a href="{{ route( 'admin.pagos_masivos.get_plantilla' ) }}" class="btn btn-success" style="padding:10px">Descargar Plantilla Excel</a>
    </center>
  </div>
  <div class="row-col-md-12">
    <center>
      <form action="{{ route('admin.pagos_masivos.store') }}" method="POST" enctype="multipart/form-data">

        <h3>Seleccione archivo a subir:</h3> 
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />

          <input type="file" name="archivo" id="archivo">
          
          <div class="row mt-5" style="margin:10px 0px 10px 0;">
            <input type="submit" value="Cargar archivo de pagos" name="submit">
          </div>

      </form>
    </center>

    @if($err)
      <table class="table">
        <head>
          <tr>
            <th>Fila</th>
            <th>Error</th>
          </tr>
        </head>
        <tbody>
            @foreach($err as $element)
            <tr>
              <td>{{ $element['line'] }}</td>
              <td>{{ $element['message'] }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
    @endif

  </div> 
</div>


@endsection

@include('templates.main2')
