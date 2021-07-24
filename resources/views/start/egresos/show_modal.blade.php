


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" 
     aria-labelledby="mySmallModalLabel" id="show_modal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" v-if="egreso">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                Egreso @{{ egreso.comprobante_egreso }}
            </a>
            <div class="list-group-item">Punto: @{{ egreso.punto.nombre }}</div>
            <div class="list-group-item">Cartera: @{{ egreso.cartera.nombre }}</div>
            <div class="list-group-item">Fecha: @{{ egreso.fecha }}</div>
            <div class="list-group-item">Concepto: @{{ egreso.concepto }}</div>
            <div class="list-group-item" v-if="egreso.proveedor">Proveedor: @{{ egreso.proveedor.nombre }}</div>
            <div class="list-group-item">Valor: @{{ egreso.valor }}</div>
            <div class="list-group-item">Tipo de pago: @{{ egreso.tipo }}</div>
            <div class="list-group-item" v-if="egreso.banco">Banco: @{{ egreso.banco }}</div>
            <div class="list-group-item" v-if="egreso.num_consignacion">Número de consignación: @{{ egreso.num_consignacion }}</div>
            <div class="list-group-item">Observaciones: @{{ egreso.observaciones }}</div>
        </div>
    </div>
  </div>
</div>