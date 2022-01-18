<?php

use Illuminate\Support\Facades\DB;

function getEnumValues2($table, $column)
{
    $type = DB::select( DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'") )[0]->Type;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $enum = array();

    foreach( explode(',', $matches[1]) as $value ) {
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

function ddmmyyyy($date) 
{
    $timestamp = strtotime($date);
    $newDate = date("m-d-Y", $timestamp);
    return $newDate;
}

function ddmmyyyyhhmmss($date)
{
    $timestamp = strtotime($date);
    $newDate = date("m-d-Y H:m:s", $timestamp);
    return $newDate;
}

function decimal($value)
{
    return number_format(
        $value, 
        0,
        ",",
        "."
    );
}

function currentYear()
{
    return date("Y");
}

function currentMonth()
{
    return date("m");
}

function saveLog($user_id ,$action ,$description ,$visible ,$ref_type ,$ref_id) 
{
    $log = new \App\Log();
    $log->user_create_id = $user_id;
    $log->action = $action;
    $log->description = $description;
    $log->visible = $visible;
    $log->ref_type = $ref_type;
    $log->ref_id = $ref_id;
    $log->save();
}

