<div class="panel panel-default">
    <div class="panel-body">

        <h2>Pagos Solicitud</h2>

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
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @php $shadow = true; $pagosSolicitud = $data['pagos_solicitud']; @endphp
                    @foreach($pagosSolicitud as $i => $pago)
                    @php if ($i > 0 && $pagosSolicitud[$i]->recibo_num !== $pagosSolicitud[$i - 1]->recibo_num) 
                        $shadow = !$shadow;
                    @endphp
                    <tr class="{{ $shadow ? 'shadow-row' : '' }}">
                        <td>{{ $pago->recibo_num }}</td>
                        <td>{{ ddmmyyyyhhmmss($pago->created_at) }}</td>
                        <td>{{ $pago->concepto }}</td>
                        <td align="right">$ {{ decimal($pago->abono) }}</td>

                        <td align="right">
                            <a 
                                href="{{ route('start.precred_pagos.show', $pago->recibo_id) }}" 
                                class='btn btn-default btn-xs'
                                data-toggle='tooltip'
                                data-placement='top'
                                title='Ver'
                            >
                                <span class='glyphicon glyphicon-eye-open'></span>
                            </a>

                            <button
                                class='btn btn-default btn-xs'
                                onclick="imprimirReciboSolicitud({{$pago->recibo_id}})"
                                data-toggle='tooltip'
                                data-placement='top'
                                title='Imprimir recibo de pago'
                            >
                                <span class='glyphicon glyphicon-print'></span>
                            </button>  
                            <button
                                class='btn btn-default btn-xs'
                                onclick="mostrarReciboSolicitud({{$pago->recibo_id}})"
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal-recibo-solicitud">
  <div class="modal-dialog" role="document" style="width:100%">
    <div class="modal-content">
      <div class="modal-body" id="modal-content-solicitud" style="height: 100vh;"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    const imprimirReciboSolicitud = async (reciboId) => {

        const html = await generarHtmlDeImpresionSolicitud(reciboId);
        let printed = window.open('','Print-Window');

        printed.document.write(html);
        printed.document.close();
        printed.print();
        
        setTimeout(() => {
            printed.close();
        }, 1000);
    }

    const generarHtmlDeImpresionSolicitud = (reciboId) => {
        let route = "{{ url('start/precredito-invoice-print') }}/" + reciboId;
        return new Promise((resolve, reject) => {
            axios.get(route)
                .then(res => resolve(res.data))
                .catch((error) => reject(error));
        });        
    }

    const mostrarReciboSolicitud = async (reciboId) => {
        $('#modal-recibo-solicitud').modal('show');
        const html = await generarHtmlDeImpresionSolicitud(reciboId);
        const content = document.getElementById('modal-content-solicitud');
        content.innerHTML = html;
    }
</script>