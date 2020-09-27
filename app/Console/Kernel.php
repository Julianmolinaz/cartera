<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         Commands\Inspire::class,
         Commands\Sanciones::class,
         Commands\VentasCommand::class,
         Commands\Cumpleanos::class,
         Commands\Morosos::class,
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->everyMinute();
        //  $schedule->command('generar:sanciones') 
        //           ->cron('01 01 * * *');  
         $schedule->command('generar:reporteVentas')
                  ->monthlyOn(1, '23:59');
         $schedule->command('generar:cumpleanos')
                  ->cron('55 10 * * *');
         $schedule->command('generar:morosos')
                  ->cron('* 13 * * *');
    }
}
