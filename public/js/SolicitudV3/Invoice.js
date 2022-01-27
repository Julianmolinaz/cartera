class Invoice {
  constructor(payload) {
    this.id = payload.id || "";
    this.nombre = payload.nombre || "";
    this.estado = payload.estado || "En proceso";
    this.fecha_exp = payload.fecha_exp || "";
    this.costo = payload.costo || "0";
    this.iva = payload.iva || "0";
    this.num_fact = payload.num_fact || "";
    this.otros = payload.otros || "0";
    this.expedido_a = payload.expedido_a || "";
    this.observaciones = payload.observaciones || "";
    this.venta_id = payload.venta_id || "";
    this.proveedor_id = payload.proveedor_id || "";
    this.precredito_id = payload.precredito_id || "";
  }
}
