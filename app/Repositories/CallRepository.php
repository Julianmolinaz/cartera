<?php 

namespace app\Repositories;

use App\Credito;

class callRepository
{
    public function callAll()
    {
        $creditos = 
        Credito::whereIn('estado',['Al dia','Mora','Prejuridico','Juridico'])->get();

        return $creditos;
    }
}