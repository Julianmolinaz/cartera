<?php

use Carbon\Carbon;

/**
 * @input $value = valor numerico
 * @return formato en miles
 */
function miles($value)
{
    return number_format($value,0,",",".");
}

function ddmmyyyySlash($value)
{
    $fecha = new Carbon($value);
    $fecha = $fecha->format('m/d/Y');

    return $fecha;
}