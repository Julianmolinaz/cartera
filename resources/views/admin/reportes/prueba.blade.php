@section('title','reporte')

@section('contenido')



<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte
        
      </div>
      <div class="panel-body">



       <table id="tabla" class="table table-bordered">
        <thead>
          <tr>
            <th>Cartera</th>
            <th>Punto</th>
            <th>Funcionario</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td rowspan="6">Gora</td>
            <td rowspan="4">Pereira</td>
            <td>f1</td>
          </tr>
          <tr><td>f2</td></tr>
          <tr><td>f3</td></tr>
          <tr><td>f4</td></tr>
          <tr>
            <td rowspan="2">Santa Rosa</td>
            <td>f5</td> 
          </tr>
          <tr><td>f6</td></tr>

        </tbody>
      </table>

    </div>
  </div>
</div>
</div>






@endsection
@include('templates.main2')


