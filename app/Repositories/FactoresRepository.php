<?php

namespace App\Repositories;

class FactoresRepository
{
    public static function getFactores($numeroMeses)
    {
        switch ($numeroMeses) {
            case 1:
                return 1.10006;
                break; 
            case 2:
                return 1.20016;
                break;
            case 3:
                return 1.3002;
                break;
            case 4:
                return 1.40008;
                break;
            case 5:
                return 1.4004;
                break;
            case 6:
                return 1.50036;
                break;
            case 7:
                return 1.49996;
                break;   
            case 8:
                return 1.5; 
                break;
            default:
                return 1.5; 
                break;
        }
    }
}