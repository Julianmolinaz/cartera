<div class="panel panel-default">
    <div class="panel-body">

        <h2>Pagos Crédito</h2>

        <hr>
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th># Recibo</th>
                        <th 
                            data-toggle='tooltip'
                            data-placement='top'
                            title='Fecha del pago'
                        >
                            Fecha
                        </th>
                        <th>Concepto</th>
                        <th>Abono</th>
                        <th>Debe</th>
                        <th>Estado</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Descuento</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @php $shadow = true; $pagosCredito = $data['pagos_credito']; @endphp
                    @foreach($pagosCredito as $i => $pago)
                    @php if ($i > 0 && $pagosCredito[$i]->recibo_num !== $pagosCredito[$i - 1]->recibo_num) 
                        $shadow = !$shadow;
                    @endphp
                    <tr class="{{ $shadow ? 'shadow-row' : '' }}">
                        <td>{{ $pago->recibo_num }}</td>
                        <td>{{ ddmmyyyyhhmmss($pago->recibo_fecha) }}</td>
                        <td>{{ $pago->concepto }}</td>
                        <td align="right">$ {{ decimal($pago->abono) }}</td>
                        <td align="right">$ {{ decimal($pago->debe) }}</td>
                        <td align="center">{{ $pago->estado }}</td>
                        <td>{{ ddmmyyyy($pago->desde) }}</td>
                        <td>{{ ddmmyyyy($pago->hasta) }}</td>
                        <td>{{ $pago->es_descuento ? 'Si' : 'No' }}</td>
                        <td align="right">
                            <a 
                                href="{{ route('start.facturas.show',$pago->recibo_id)}}" 
                                class='btn btn-default btn-xs'
                                data-toggle='tooltip'
                                data-placement='top'
                                title='Ver'
                            >
                                <span class='glyphicon glyphicon-eye-open'></span>
                            </a>

                            <button
                                class='btn btn-default btn-xs'
                                onclick="imprimirRecibo({{$pago->recibo_id}})"
                                data-toggle='tooltip'
                                data-placement='top'
                                title='Imprimir recibo de pago'
                            >
                                <span class='glyphicon glyphicon-print'></span>
                            </button>  
                            <button
                                class='btn btn-default btn-xs'
                                onclick="mostrarRecibo({{$pago->recibo_id}})"
                                data-toggle='tooltip'
                                data-placement='top'
                                title='Mostrar recibo de pago'
                            >
                                <span class='glyphicon glyphicon-export'></span>
                            </button>  
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-recibo">
  <div class="modal-dialog" role="document" style="width:100%">
    <div class="modal-content">
      <div class="modal-body" id="modal-content" style="height: 100vh;"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    const imprimirRecibo = async (reciboId) => {

        const html = await generarHtmlDeImpresion(reciboId);
        let printed = window.open('','Print-Window');

        printed.document.write(html);
        printed.document.close();
        printed.print();
        
        setTimeout(() => {
            printed.close();
        }, 1000);
    }

    const generarHtmlDeImpresion = (reciboId) => {
        let route = "{{ url('start/invoice-print') }}/" + reciboId;
        return new Promise((resolve, reject) => {
            axios.get(route)
                .then(res => resolve(res.data))
                .catch((error) => reject(error));
        });        
    }

    const mostrarRecibo = async (reciboId) => {
        $('#modal-recibo').modal('show');
        const html = await generarHtmlDeImpresion(reciboId);
        const content = document.getElementById('modal-content');
        content.innerHTML = html;
    }
</script>