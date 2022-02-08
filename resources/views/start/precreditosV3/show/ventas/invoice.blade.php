@if($venta['invoice'])
@php $invoice = (object)$venta['invoice'] @endphp
<div style="background-color: #eeecf33b;">
    <div class="card-content__item">
        <!-- FACTURA -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Factura</div>
            <div style="font-weight: 700; word-wrap: break-word">{{ $invoice->num_fact }}</div>
        </div>
        <!-- ESTADO FACTURA -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Estado</div>
            <div>
                @if($invoice->estado === 'En proceso')
                    <span class="pg-tag pg-tag--danger">{{ $invoice->estado }}</span>
                @elseif($invoice->estado === 'Aprobado')
                    <span class="pg-tag pg-tag--primary">{{ $invoice->estado }}</span>
                @elseif($invoice->estado === 'Pagado')
                    <span class="pg-tag pg-tag--flow">{{ $invoice->estado }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="card-content__item">
        <!-- FECHA DE EXPEDICIÓN FACTURA -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Fecha de expedición</div>
            <div>{{ ddmmyyyy($invoice->fecha_exp) }}</div>
        </div>
        <!-- COSTO FACTURA -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Costo</div>
            <div>$ {{ decimal($invoice->costo) }}</div>
        </div>
        <!-- IVA FACTURA -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">IVA</div>
            <div>$ {{ decimal($invoice->iva) }}</div>
        </div>
    </div>
    <div class="card-content__item">
        <!-- OTROS FACTURA -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Otros</div>
            <div>$ {{ decimal($invoice->otros) }}</div>
        </div>
        <!-- EXPEDIDO A (FACTURA) -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Expedido a</div>
            <div>{{ $invoice->expedido_a }}</div>
        </div>
        <!-- PROVEEDOR FACTURA -->
        <div class="card-content__subitem">
            <div class="card-content__subitem-title">Proveedor</div>
            <div>{{ $invoice->proveedor }}</div>
        </div>
    </div>
</div>
@else
    <center style="color:#ef3f3f;">
        <br>
        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
        <p>Pendiente de facturar</p>
    </center>
@endif