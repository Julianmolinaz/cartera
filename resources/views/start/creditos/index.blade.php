@section('title','Creditos')
@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading"><h2>Créditos
    <a href="#" class = 'btn btn-default btn-xs' OnClick="alert('Ayuda');" data-toggle="tooltip" data-placement="top" title="Ayuda">
                <span class = "glyphicon glyphicon-question-sign" ></span>
              </a> 
      <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button>
    </h2></div>
    <div class="panel-body">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>
       
       <table id="datatable"  data-order='[[ 0, "desc" ]]'class="table table-striped table-bordered" style="font-size:11px">
        <thead>
          <tr  style="background-color:#FFC300;">
            <th style="display:none;">    Actualizacion  </th>
            <th> <small>   Credito id </small> </th>
            <th>    Factura       </th>
            <th>    Cartera       </th>
            <th>    Fecha Creación</th>
            <th>    Cliente       </th>
            <th>    Documento     </th>
            <th>    Estado        </th>
            <th>    Dias en mora  </th>
            <th>    Refinanciación</th>
            <th>    Cuotas        </th>
            <th>    Saldo         </th>
            <th>    Fecha de pago </th>
            <th>    Pago hasta    </th>
            <th>    Observaciones </th>
            <th>    Creó          </th>
            <th>    Acciones      </th>
          </tr>
          </thead>
          <tbody>

            @foreach($creditos as $credito)
              @if($credito->estado == 'Cancelado' || $credito->estado == 'Finalizado')
                <tr class="danger">
              @else    
                <tr>
              @endif    
              <td style="display:none;"> {{$credito->updated_at}}</td>
              <td> {{$credito->id}}          </td>
              <td> {{$credito->precredito->num_fact}}    </td>
              <td> {{$credito->precredito->cartera->nombre}}</td>
              <td> {{$credito->precredito->fecha}}       </td>
              <td> {{$credito->precredito->cliente->nombre}}</td>
              <td> {{$credito->precredito->cliente->num_doc}}</td>

              <td>
                @if($credito->estado == 'Al dia')

                  <spam class="label label-primary">{{$credito->estado}}</spam>

                @elseif($credito->estado == 'Mora')
                
                  <spam class="label label-danger">{{$credito->estado}}<spam>  

                @elseif($credito->estado == 'Prejuridico')

                  <spam class="label label-success  ">{{$credito->estado}}</spam>

                @elseif($credito->estado == 'Juridico')

                  <spam class="label label-info">{{$credito->estado}}</spam>

                @else
                  <spam class="label label-warning">{{$credito->estado}}</spam>
                @endif

              </td>

              <?php
                if(count($credito->sanciones) >= 1 ){
                  $sanciones = 0;
                  foreach($credito->sanciones as $sancion){
                    if($sancion->estado == 'Debe'){
                      $sanciones++;
                    }
                  }
                  echo "<td>".$sanciones."</td>"; 
                }   
                else{
                  echo "<td>0</td>";
                }        

              ?>

              <td> {{ $credito->refinanciacion }} </td>
              <td> {{$credito->cuotas_faltantes.' de '.$credito->precredito->cuotas.' '.$credito->precredito->periodo.' * '.number_format($credito->precredito->vlr_cuota,0,",",".")}}</td>
              <td align="right"> {{number_format($credito->saldo,0,",",".")}}</td>
              <td> {{$credito->precredito->p_fecha.'-'.$credito->precredito->s_fecha }} </td>
              <td> {{ $credito->fecha_pago->fecha_pago}}</td>
              <td> {{$credito->precredito->observaciones}}</td>
              <td> <small>{{$credito->user_create->name.' ('.$credito->created_at.')'}}</small></td>

              <td>
                <a href="{{route('start.precreditos.ver',$credito->precredito->id)}}"
                  class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Ver crédito"><span class = "glyphicon glyphicon-eye-open" ></span></a>

                <a href="{{route('start.clientes.show',$credito->precredito->cliente_id)}}" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Ver cliente"><span class = "glyphicon glyphicon-user" ></span></a>

                <a href="{{route('start.facturas.create',$credito->id)}}" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Hacer pagos"><span class = "glyphicon glyphicon-usd" ></span></a>

                <a href="{{route('admin.sanciones.show',$credito->id)}}" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Ver sanciones diarias"><span class = "glyphicon glyphicon-record" ></span></a>

                <a href="{{route('admin.multas.show',$credito->id)}}" class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Crear cobros prejurídicos o jurídicos"><span class = "glyphicon glyphicon-hourglass" ></span></a>

                 <a href="{{route('start.creditos.edit',$credito->id)}}" class = 'btn btn-default btn-xs'  data-toggle="tooltip" data-placement="top" title="Editar"><span class = "glyphicon glyphicon-pencil"></a>

                </td>
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

      $('#datatable').dataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  
        'scrollY': 400,
        "scrollCollapse": true
        });

      });

    function Exportar(){
      $('#datatable').table2excel({
        name: 'creditos',
        filename: "creditos.xls"
      });
    }
  </script>




  @endsection
  @include('templates.main2')
