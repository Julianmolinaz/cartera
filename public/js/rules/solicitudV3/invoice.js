const rules_invoice = {
    expedido_a: {
        name: "Expedido a",
        rule: "",
        required: "",
    },
    proveedor_id: {
        name: "proveedor",
        rule: "required",
        required: "*",
    },
    costo: {
        name: "costo",
        rule: "required|decimal",
        required: "*",
    },
    num_fact: {
        name: "número de factura",
        rule: "alpha_num",
        required: "",
    },
    fecha_exp: {
        name: "fecha de expedicion",
        rule: "",
        required: "",
    },
    iva: {
        name: "iva",
        rule: "decimal",
        required: "",
    },
    otros: {
        name: "otros",
        rule: "decimal",
        required: "",
    },
    estado: {
        name: "estado",
        rule: "",
        required: "",
    },
    observaciones: {
        name: "observaciones",
        rule: "",
        required: "",
    }
};
