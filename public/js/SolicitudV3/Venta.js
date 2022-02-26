class Venta {
  constructor(payload) {
    this.id = payload.id || "";
    this.producto = payload.producto || "";
    this.precredito_id = payload.precredito_id || "";
    this.vehiculo = payload.vehiculo || "";
    this.valor = payload.valor || "";
  }
}
