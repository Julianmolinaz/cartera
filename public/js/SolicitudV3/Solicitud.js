class Solicitud {
  constructor(payload) {
    this.id = payload.id || "";
    this.num_fact = payload.num_fact || "";
    this.fecha = payload.fecha || "";
    this.cartera_id = payload.cartera_id || "";
    this.funcionario_id = payload.funcionario_id || "";
    this.cliente_id = payload.cliente_id || "";
    this.vlr_fin = payload.vlr_fin || "";
    this.periodo = payload.periodo || "";
    this.meses = payload.meses || "";
    this.cuotas = payload.cuotas || "";
    this.vlr_cuota = payload.vlr_cuota || "";
    this.vlr_asistencia = payload.vlr_asistencia || "";
    this.p_fecha = payload.p_fecha || "";
    this.s_fecha = payload.s_fecha || "";
    this.estudio = payload.estudio || "";
    this.cuota_inicial = payload.cuota_inicial || "";
    this.aprobado = payload.aprobado || "En proceso";
    this.observaciones = payload.observaciones || "";
  }
}
