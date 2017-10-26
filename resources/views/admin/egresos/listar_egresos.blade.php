@section('title','todos los egresos')

@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>
          Todos los Egresos
          <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button> 
        </h2>
      </div>
      <div class="panel-body">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>

       <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:10px">
        <thead>
          <tr>
            <th>    Egreso id               </th>
            <th>    Comprobante de Egreso   </th>
            <th>    Concepto                </th>
            <th>    Fecha                   </th>
            <th>    Valor                   </th>
            <th>    Observaciones           </th>
            <th>    Cartera                 </th>
            <th>    Creó                    </th>
            <th>    Actualizó               </th>

          </tr>
        </thead>

        <tbody>
          @foreach($egresos as $egreso)
          <tr>
            <td>{{$egreso->id}}</td>
            <td>{{$egreso->comprobante_egreso}}</td>
            <td>{{$egreso->concepto}}</td>
            <td>{{$egreso->fecha}}</td>
            <td align="right">{{number_format($egreso->valor,0,",",".")}}</td>
            <td>{{$egreso->observaciones}}</td>
            <td>{{$egreso->cartera->nombre}}</td>
            <td>{{$egreso->user_create->name.' '.$egreso->created_at}}</td>
            <td>{{$egreso->user_update->name.' '.$egreso->updated_at}}</td>
          </tr>   

          @endforeach


        </tbody>
      </table>

    </div>
  </div>
</div>     
</div>


  <script>
    $( document ).ready(function() {
      $('#datatable').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  
        'scrollY': 400,
        "scrollCollapse": true
      });
    });

    function Exportar(){
      $('#datatable').table2excel({
        name: 'todos_los_egresos',
        filename: "todos_los_egresos.xls"
      });
    }
  </script>

@endsection

@include('templates.main2')