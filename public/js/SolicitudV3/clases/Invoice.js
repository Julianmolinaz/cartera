class Invoice {
    constructor(payload) {
        this.id = {
            val         : payload.id || null,
            reglas      : "",
            nombre      : "Id",
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
