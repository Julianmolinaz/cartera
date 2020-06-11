const rules_credito = {

    
estado          : { name: 'estado',           rule: '',                             required: ''},
valor_credito   : { name: 'valor',            rule: 'required|decimal',             required: '*'},
saldo           : { name: 'saldo',            rule: 'required|decimal|min_value:0', required: '*'},
cuotas_faltantes: { name: 'cuotas faltantes', rule: 'required|numeric',             required: '*'},
rendimiento     : { name: 'rendimiento',      rule: 'decimal',                      required: ''},
saldo_favor     : { name: 'saldo a favor',    rule: 'required|decimal',             required: '*'},
castigada       : { name: 'castigada',        rule: '',                             required: ''},
mes             : { name: 'mes',              rule: 'required',                     required: '*'},
anio            : { name: 'año',              rule: 'required',                     required: '*'},
observaciones   : { name: 'observaciones',    rule: '',                             required: ''}
}