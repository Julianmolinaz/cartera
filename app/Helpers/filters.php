<?php

/**
 * @input $value = valor numerico
 * @return formato en miles
 */
function miles($value)
{
    return number_format($value,0,",",".");
}