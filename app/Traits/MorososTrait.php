<?php 

namespace App\Traits;
use Auth;
use Carbon\Carbon;
use DB;


trait MorososTrait 
{
    public function get_morosos()
    {
        $creditos = $this->creditos_a_revisar();
        $array_creditos = [];
        
        foreach($creditos as $credito)
        {
            $sanciones = $this->sanciones($credito);
            $cliente = ucwords(strtolower($credito->cliente) );
          
            if($sanciones > 5){
                $temp = ['telefono' => $credito->telefono, 
                         'mensaje'  => "Querido cliente $cliente, INVERSIONES GORA SAS le informa que su crédito presenta una mora de $sanciones dias, lo invitamos a que pueda normalizar su obligación. Cualquier inquietud comunicarse al Tel: 3104450956 o visitenos a www.inversionesgora.com"
                        ];

                array_push($array_creditos,$temp);
            }
        }

        return $array_creditos;
    }


    /**
     *  recibe un credito y retorna el numero de sanciones sin pagar
     */

    protected function sanciones($credito)
    {
        $sanciones = 
        DB::table('sanciones')
            ->where([['credito_id','=',$credito->id],['estado','=','Debe']])
            ->count(); 

        return $sanciones;
    }

    /**
     * Genera un listado de creditos en estado mora, prejuridico y juridico
     */

    protected function creditos_a_revisar()
    {
        $creditos = 
        DB::table('creditos')
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->select('creditos.id as id',
                     'clientes.nombre as cliente',
                     'clientes.movil as telefono')
            ->whereIn('creditos.estado',['Mora','Prejuridico'])
            ->get();

        return $creditos;
    }
}