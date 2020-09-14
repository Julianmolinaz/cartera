@section('title','Pagos')

@section('contenido')


<div class="container">
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

    <table class="table">
      <head>
        <tr>
          <th>Linea</th>
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

  </div> 
</div>


@endsection

@include('templates.main2')
