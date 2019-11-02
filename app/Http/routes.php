<?php

require __DIR__ . '/routes/general.php';

require __DIR__ . '/routes/simulador.php';

require __DIR__ . '/routes/financiero.php';

require __DIR__ . '/routes/clientes.php';

require __DIR__ . '/routes/callcenter.php';

require __DIR__ . '/routes/contabilidad.php';

require __DIR__ . '/routes/creditos.php';

require __DIR__ . '/routes/precreditos.php';

require __DIR__ . '/routes/estudios.php';

require __DIR__ . '/routes/pagos_creditos.php';


Route::get('ventasMes/{user_id}/{date}', function($user_id, $date){
    
    $date = new \Carbon\Carbon($date);
    $month = $date->month;
    $mes = '';

    switch ($month) {
        case '1': $mes = 'Enero'; break;
        case '2': $mes = 'Febrero'; break;
        case '3': $mes = 'Marzo'; break;
        case '4': $mes = 'Abril'; break;
        case '5': $mes = 'Mayo'; break;
        case '6': $mes = 'Junio'; break;
        case '7': $mes = 'Julio'; break;
        case '8': $mes = 'Agosto'; break;
        case '9': $mes = 'Septiembre'; break;
        case '10': $mes = 'Octubre'; break;
        case '11': $mes = 'Noviembre'; break;
        case '12': $mes = 'Diciembre'; break;
    }

    return \DB::table('creditos')
        ->join('precreditos','creditos.precredito_id','=','precreditos.id')
        ->join('users','precreditos.user_create_id','=','users.id')
        ->where('users.id',$user_id)
        ->where('creditos.mes', $mes)
        ->where('creditos.anio', $date->year)
        ->sum('precreditos.vlr_fin');
});