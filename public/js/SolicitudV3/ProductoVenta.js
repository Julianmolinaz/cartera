class ProductoVenta {
  constructor(payload) {
    this.nombre = payload.nombre || "";
    this.cantidad = payload.cantidad || "";
    this.producto_id = payload.producto_id || "";
    this.con_vehiculo = payload.con_vehiculo || false;
  }
}
