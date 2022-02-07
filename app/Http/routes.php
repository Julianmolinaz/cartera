<?php

require __DIR__ . '/routes/variables.php';

require __DIR__ . '/routes/carteras.php';

require __DIR__ . '/routes/general.php';

require __DIR__ . '/routes/simulador.php';

require __DIR__ . '/routes/financiero.php';

require __DIR__ . '/routes/clientes.php';

require __DIR__ . '/routes/documentos.php';

require __DIR__ . '/routes/callcenter.php';

require __DIR__ . '/routes/creditos.php';

require __DIR__ . '/routes/creditosV3.php';

require __DIR__ . '/routes/precreditos.php';

require __DIR__ . '/routes/precreditosV3.php';

require __DIR__ . '/routes/estudios.php';

require __DIR__ . '/routes/facturas.php';

require __DIR__ . '/routes/pago_creditos.php';

require __DIR__ . '/routes/ref_productos.php';

require __DIR__ . '/routes/roles.php';

require __DIR__ . '/routes/codeudores.php';

require __DIR__ . '/routes/otros_pagos.php';

require __DIR__ . '/routes/pago_solicitudes.php';

require __DIR__ . '/routes/egresos.php';

require __DIR__ . '/routes/multas.php';

require __DIR__ . '/routes/gestion_carteras.php';

require __DIR__ . '/routes/negocios.php';

require __DIR__ . '/routes/users.php';

require __DIR__ . '/routes/puntos.php';

require __DIR__ . '/routes/zonas.php';

require __DIR__ . '/routes/productos.php';

require __DIR__ . '/routes/criteriocall.php';

require __DIR__ . '/routes/reportes.php';

require __DIR__ . '/routes/conyuges.php';

require __DIR__ . '/routes/oficios.php';

require __DIR__ . '/routes/sanciones.php';

require __DIR__ . '/routes/anotaciones.php';

require __DIR__ . '/routes/pagos_masivos.php';

require __DIR__ . '/routes/facturacion.php';

require __DIR__ . '/routes/test.php';

require __DIR__ . '/routes/certificados.php';

require __DIR__ . '/routes/anuladas.php';

require __DIR__ . '/routes/acuerdos.php';

require __DIR__ . '/routes/contabilidad/home.php';

require __DIR__ . '/routes/contabilidad/reportes.php';

require __DIR__ . '/routes/cajas.php';

require __DIR__ . '/routes/refinanciacion.php';

require __DIR__ . '/routes/vehiculos.php';

require __DIR__ . '/routes/fecha_cobros.php';


Route::group(['prefix' =>'api'], function() {
    
    require __DIR__ . '/routes/api/recibos.php';

    require __DIR__ . '/routes/api/productos.php';

    require __DIR__ . '/routes/api/creditosV3.php';

    require __DIR__ . '/routes/api/precreditosV3.php';

    require __DIR__ . '/routes/api/facturacion.php';

    require __DIR__ . '/routes/api/refinanciacion.php';

    require __DIR__ . '/routes/api/tipo_vehiculos.php';

    require __DIR__ . '/routes/api/ventas.php';
});