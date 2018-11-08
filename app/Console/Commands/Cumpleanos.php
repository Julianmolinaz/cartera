<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Cliente;
use Carbon\Carbon;
use App\Traits\Mensaje;
use DB;

class Cumpleanos extends Command
{
    use Mensaje;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:cumpleanos';

    /**
     * The console command description.
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();
        $hoy_DMY = $now->format('d-m-Y');
        $hoy_YMD = $now->format('Y-m-d');
        $telefonos = array();

        $clientes = DB::table('clientes')
            ->where('fecha_nacimiento','=',$hoy_DMY)
            ->orWhere('fecha_nacimiento','=',$hoy_YMD)
            ->get();

        foreach($clientes as $cliente)
        {
            if($cliente->movil)
                array_push($telefonos,$cliente->movil);

        }

        $this->send_message($telefonos,'MSS666');

        
    }
}
