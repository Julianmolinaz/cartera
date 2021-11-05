class Vehiculo {
    constructor(payload) {
        this.id = {
            val         : payload.id || null,
            reglas      : "",
            nombre      : "Id",
            activo      : true,
            visible     : false
        };
        this.tipo = {
            val         : payload.tipo || '',
            reglas      : "",
            nombre      : "Tipo",
            activo      : true,
            visible     : true
        };
        this.placa = {
            val         : payload.placa || '',
            reglas      : "",
            nombre      : "Placa",
            activo      : true,
            visible     : true
        };
        this.vencimiento_soat = {
            val         : payload.vencimiento_soat || '',
            reglas      : "",
            nombre      : "SOAT",
            activo      : true,
            visible     : true
        };
        this.vencimiento_rtm = {
            val         : payload.vencimiento_soat || '',
            reglas      : "",
            nombre      : "RTM",
            activo      : true,
            visible     : true
        };
        this.modelo = {
            val         : payload.modelo || '',
            reglas      : "",
            nombre      : "Modelo",
            activo      : true,
            visible     : true
        };
        this.cilindraje = {
            val         : payload.cilindraje || '',
            reglas      : "",
            nombre      : "Cilindraje",
            activo      : true,
            visible     : true
        };
        this.observaciones = {
            val         : payload.observaciones || '',
            reglas      : "",
            nombre      : "Observaciones",
            activo      : true,
            visible     : true
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
