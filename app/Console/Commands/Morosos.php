<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Auth;
use App\Credito;
use App\Traits\Mensaje;

class Morosos extends Command
{
    use Mensaje;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:morosos';

    /**
     * envía mensajes de texto cuando los creditos tienen una mora 
     * determinada
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            ->whereIn('estado',['Mora','Juridico','Prejuridico'])
            ->get();

        return $creditos;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $c = 5; 
        $v = 20;

        $creditos = $this->creditos_a_revisar();

        $array_5   = array();
        $array_20  = array();

        foreach($creditos as $credito)
        {
            if($this->sanciones($credito) == $c)
            {
                $credit = Credito::find($credito->id);
                array_push($array_5, $credit->precredito->cliente->movil);
            }
            elseif($this->sanciones($credito) == $v)
            {
                $credit = Credito::find($credito->id);
                array_push($array_20, $credit->precredito->cliente->movil);
            }
        }

        $this->send_message($array_5,'MSS222');
        $this->send_message($array_20,'MSS333');

    }
}
