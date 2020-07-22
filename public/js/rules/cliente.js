const rules_personales = {
    primer_nombre:      { name: 'primer nombre',        rule: 'required|alpha'},
    segundo_nombre:     { name: 'segundo nombre',       rule: ''},
    primer_apellido:    { name: 'primer apellido',      rule: 'required|alpha'},
    segundo_apellido:   { name: 'segundo apellido',     rule: ''},
    tipo_doc :          { name: 'tipo de documento',    rule: 'required|numeric'},
    num_doc :           { name: 'numero de documento',  rule: 'required|numeric'},
    lugar_exp :         { name: 'lugar de expedicion',  rule: 'required|alpha'},
    fecha_exp :         { name: 'fecha de expedicion',  rule: 'required|date'},
    fecha_nacimiento :  { name: 'fecha de nacimiento',  rule: 'required|date'},
    lugar_nacimiento :  { name: 'lugar de nacimiento',  rule: 'required|alpha'},
    nivel_estudios :    { name: 'nivel de estudios',    rule: 'required|alpha'},
    estado_civil :      { name: 'estado civil',         rule: 'required|alpha'},
}

const rules_ubicacion = {
    direccion              : { name: 'direccion',            rule: 'required|alpha_num' },
    barrio                 : { name: 'barrio',               rule: 'required|alpha_num' },
    municipio              : { name: 'municipio',            rule: 'required|alpha_num' },
    movil                  : { name: 'celular',              rule: 'required|numeric' },
    fijo                   : { name: 'telefono',             rule: 'alpha_num' },
    email                  : { name: 'correo electronico',   rule: 'required|email' },
    estrato                : { name: 'estrato',              rule: 'required|integer' }, 
    anos_residencia        : { name: 'años en residencia',   rule: 'required|integer'}, 
    meses_residencia       : { name: 'meses en residencia',  rule: 'required|integer'}, 
    tipo_vivienda          : { name: 'tipo de vivienda',     rule: 'required' }, 
    envio_correspondencia  : { name: 'envio de correspondencia', rule: '' }, 
    nombre_arrendador      : { name: 'nombre arrendador',    rule: '' }, 
    telefono_arrendador    : { name: 'telefono arrendador',  rule: 'alpha_num'}
}

const rules_economica = {
    ocupacion             : { name : 'ocupacion',           rule: 'required' },
    tipo_actividad        : { name : 'tiipo de actividad',  rule: 'required' },
    empresa               : { name : 'nombre empresa',      rule: 'alpha_num' },
    tel_empresa           : { name : 'telefono empresa',    rule: 'numeric' },
    dir_empresa           : { name : 'direccion empresa',   rule: 'alpha_num' },
    doc_empresa           : { name : 'identificacion empresa', rule: '' },
    cargo                 : { name : 'cargo',               rule: 'alpha_num' },
    tipo_contrato         : { name : 'tipo de contrato',    rule: '' },
    fecha_vinculacion     : { name : 'fecha de vincalacion',rule: '' },
    descripcion_actividad : { name : 'descripcion de la actividad', rule: '' }
}