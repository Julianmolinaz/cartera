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
          
            if($sanciones > 10){
                $temp = ['telefono' => $credito->telefono, 
                         'mensaje'  => "Estimado $cliente, INVERSIONES GORA SAS informa que su crédito presenta mora de $sanciones dias, lo invitamos a normalizar su obligación, recuerde que puede pagar en la cta de ahorros Colpatria o via Baloto 6962014925. Inquietudes 3104450956, 3222081400. www.financiamossoat.com"
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

    /** 
     * recibe un objetotipo credito
     * calcula segun el numero de sanciones_debe
     * el tipo de moroso
     */


    function tipoMorosoTr($credito)
    {
        $sanciones = $credito->sanciones_debe;

        if ($sanciones > 0 && $sanciones <= 30) {
            $tipo_moroso = 'Morosos ideales';
        }
        elseif ($sanciones > 30 && $sanciones <= 90) {
            $tipo_moroso = 'Morosos alerta';
        }
        elseif ($sanciones > 90) {
            $tipo_moroso = 'Morosos criticos';
        }
        else {
            $tipo_moroso = 'No moroso';
        }

        return $tipo_moroso;
    }

    /**
     * transforma un tipo de mora generado por el metodo 
     * tipoMorosoTr() en un iten de una sola frace para el procesamiento
     * de reportes
     * @recibe un $tipoMora ej: 'Morosos ideales' => 'ideal'
     */

    public function translateTypeMoraTr($tipoMora)
    {
        switch ($tipoMora) {
            case 'Morosos ideales':
                return 'ideal';
                break;
            case 'Morosos alerta':
                return 'alerta';
                break;
            case 'Morosos criticos':
                return 'critica';
                break;                
            default:
                return 'alDia';
                break;
        }
    }
}
