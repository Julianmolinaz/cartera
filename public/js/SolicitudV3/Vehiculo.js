class Vehiculo {
  constructor(payload) {
    this.id = payload.id || "";
    this.tipo_vehiculo_id = payload.tipo_vehiculo_id || "";
    this.placa = payload.placa || "";
    this.vencimiento_soat = payload.vencimiento_soat || "";
    this.vencimiento_rtm = payload.vencimiento_rtm || "";
    this.modelo = payload.modelo || "";
    this.cilindraje = payload.cilindraje || "";
    this.observaciones = payload.observaciones || "";
  }
}
