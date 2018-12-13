@section('title','Cancelados')
@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading"><h2>Cancelados <i class="fab fa-angellist"></i>


 
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
            <th>    Cartera       </th>
            <th>    Fecha Creación</th>
            <th>    Cliente       </th>
            <th>    Documento     </th>
            <th>    Estado        </th>
            <th>    Refinanciación</th>
            <th>    Padre         </th>
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
              <tr>
                <td style="display:none;"> {{$credito->updated_at}}</td>
                <td> {{$credito->id}}         </td>
                <td> {{$credito->cartera}}    </td>
                <td> {{$credito->fecha}}      </td>
                <td> {{$credito->cliente}}    </td>
                <td> {{$credito->doc}}        </td>

                <td>
                  @if($credito->estado == 'Cancelado')

                    <spam class="label label-primary">
                        {{$credito->estado}}
                    </spam>

                  @elseif($credito->estado == 'Cancelado por refinanciacion')
                  
                    <spam class="label label-danger">
                      {{$credito->estado}}
                    <spam>  
                    
                  @endif

                </td>

                <td> {{ $credito->refinanciado }} </td>
                <td> {{ $credito->padre}}         </td>
                <td> {{$credito->cuotas_faltantes.' de '.$credito->cuotas.' '.$credito->periodo.' * '.number_format($credito->vlr_cuota,0,",",".")}}</td>
                <td align="right"> {{number_format($credito->saldo,0,",",".")}}</td>
                <td> {{$credito->p_fecha.'-'.$credito->s_fecha }} </td>
                <td> {{ $credito->fecha_pago}}                    </td>
                <td> {{$credito->observaciones}}                  </td>
                <td> <small>{{$credito->user_create.' ('.$credito->created_at.')'}}</small></td>

                <td>
                  <a href="{{route('start.precreditos.ver',$credito->id)}}"
                    class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" title="Ver crédito">
                    <span class = "glyphicon glyphicon-eye-open" ></span>
                  </a>

                  <a href="{{route('start.clientes.show',$credito->cliente_id)}}" 
                    class = 'btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" 
                    title="Ver cliente"><span class = "glyphicon glyphicon-user" ></span>
                  </a>
                </td>
              </tr>

              @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div style="margin-left:30px;">
    {{ $creditos->links() }}
  </div>

  <script>
    $( document ).ready(function() {

      $('#datatable').dataTable({
        'scrollY' : 400,
        'paging'  : false,
        "scrollCollapse": true,
        "iDisplayLength": 500
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
