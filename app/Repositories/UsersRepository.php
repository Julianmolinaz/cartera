<?php

namespace App\Repositories;
use DB;

class UserRepository
{
    public static function find($userId)
    {
        $user = DB::table("users")
            ->where("id", $userId)
            ->first();

        return $user;
    }
}