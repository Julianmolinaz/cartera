<?php

use Illuminate\Support\Facades\DB;

function getEnumValues2($table, $column)
{
  $type = DB::select( DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'") )[0]->Type;
  preg_match('/^enum\((.*)\)$/', $type, $matches);
  $enum = array();
  foreach( explode(',', $matches[1]) as $value )
  {
    $v = trim( $value, "'" );
    $enum[] = $v;
  }
  return $enum;
}

function resHp($success, $data, $message, $status=200)
{
    return response()->json([
        'success' => $success,
        'dat'     => $data,
        'message' => $message 
    ], $status);
}

function castErrors($validator_errors) 
{
    $arr = [];
    $collection =  collect($validator_errors)->values()->all();

    foreach ($collection as $element) {
        foreach ($element as $item) {
            $arr[] = $item;
        }
    }

    return $arr;
}

