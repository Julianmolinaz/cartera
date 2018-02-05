<?php

namespace App\Console\Commands;
use App\Http\Controllers\ReporteController;

use Illuminate\Console\Command;

class VentasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:reporteVentas';

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
        $reporteVentas = new ReporteController();
        $reporteVentas->setFecha1("01/12/2017");
        $reporteVentas->setFecha2("29/01/2018");
        $reporteVentas->ventas();
        
    }
}
