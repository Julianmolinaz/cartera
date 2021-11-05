const rules_vehiculo = {
    tipo_vehiculo: {
        name: 'tipo vehículo',
        rule: 'required',
        required: '*'
    },
    placa: {
        name: 'placa',
        rule: 'required|alpha_num',
        required: '*'
    },
    modelo: {
        name: 'modelo',
        rule: 'required|numeric',
        required: '*'
    },
    cilindraje: {
        name: 'cilindraje',
        rule: 'required|numeric',
        required: '*'
    },
    vencimiento_soat: {
        name: 'vencimiento soat',
        rule: 'required',
        required: '*'
    },
    vencimiento_rtm: {
        name: 'vencimiento rtm',
        rule: 'required',
        required: '*'
    }
}
