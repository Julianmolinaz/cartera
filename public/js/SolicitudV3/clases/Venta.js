class Venta {
    constructor(payload) {
        this.id = {
            val         : payload.id || null,
            reglas      : "",
            nombre      : "Id",
            activo      : true,
            visible     : false
        };
        this.nombre = {
            val         : payload.nombre || '',
            reglas      : "",
            nombre      : "Nombre",
            activo      : true,
            visible     : true
        };
        this.cantidad = {
            val         : payload.cantidad || 1,
            reglas      : "",
            nombre      : "Cantidad",
            activo      : true,
            visible     : true
        };
        this.producto_id = {
            val         : payload.producto_id || null,
            reglas      : "",
            nombre      : "ProductoId",
            activo      : true,
            visible     : false
        };
        this.precredito_id = {
            val         : payload.precredito_id || null,
            reglas      : "",
            nombre      : "PrecreditoId",
            activo      : true,
            visible     : false
        };
        this.vehiculo_id = {
            val         : payload.vehiculo_id || null,
            reglas      : "",
            nombre      : "VehiculoId",
            activo      : true,
            visible     : false
        };
    }
    onlyValues() {
        const keys = Object.keys(this);
        let temp = Object.create({});
    
        keys.forEach(key => {
            temp[key] = this[key].val
        });
    
        return temp;
    }
}
