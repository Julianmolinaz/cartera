class Venta {

    constructor (payload) {
        this.id            = payload.id             || '',
        this.nombre        = payload.nombre         || '',
        this.cantidad      = payload.cantidad       || '',
        this.producto_id   = payload.producto_id    || '',
        this.precredito_id = payload.precredito_id  || '',
        this.vehiculo_id   = payload.vehiculo_id    || ''
    }
    
}