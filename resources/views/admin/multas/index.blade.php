@section('title','multas')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-warning">

      <div class="panel-heading">
        <h2>
          Multas
          <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button> 
        </h2>
      </div>  
      
       <div class="panel-body">

        <p>

         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>
        <div class="table-responsive">
          <table id="datatable"  data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
            <thead>
              <tr>
                <th style="display:none;">    Actualizacion  </th>  
                <th>    Multa Id      </th>
                <th>    Credito Id    </th>
                <th>    Cliente       </th>
                <th>    Documento     </th>
                <th>    Saldo Crédito </th>
                <th>    Estado Crédito</th>
                <th>    Fecha         </th>
                <th>    Concepto      </th>
                <th>    Estado Multa  </th>
                <th>    Valor         </th>
                <th>    Descripción   </th>
                <th>    Creó          </th>
                <th>    Actualizó          </th>
                <th>    Actividad     </th>

              </tr>
            </thead>
            <tbody>
              @foreach($extras as $extra)
              <tr>
                <td style="display:none;"> {{$extra->updated_at}}</td>
                <td> {{ $extra->id}}                                                  </td>   
                <td> {{ $extra->credito->id }}                                        </td>  
                <td> {{ $extra->credito->precredito->cliente->nombre}}                </td>
                <td align="right"> {{ $extra->credito->precredito->cliente->num_doc}} </td>
                <td align="right"> {{ number_format($extra->credito->saldo,0,",",".")}}</td>  
                <td>{{ $extra->credito->estado}}                                      </td>  
                <td>{{ $extra->fecha}}                                                </td>  
                <td>{{ $extra->concepto}}                                             </td>  
                <td>{{ $extra->estado }}                                              </td>  
                <td align="right">{{ number_format($extra->valor,0,",",".") }}        </td>  
                <td>{{ $extra->descripcion}}                                          </td> 
                <td>{{ $extra->user_create->name.' '.$extra->created_at}}             </td>
                <td>{{ $extra->user_update->name.' '.$extra->updated_at}}             </td> 
                <td>
                  <a href="{{route('admin.multas.show',$extra->credito->id)}}" class = 'btn btn-default btn-xs'
                  data-toggle="tooltip" data-placement="top" title="Ver crédito">
                      <span class = "glyphicon glyphicon-eye-open" title="Ver"></a>

                </td>  
              </tr>  
              @endforeach
            </tbody>  
          
          </table>
        </div>
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
        name: 'multas',
        filename: "multas.xls"
      });
    }
  </script>

@endsection
@include('templates.main2')