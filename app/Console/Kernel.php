<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // ----start----- bu ozellik odeme zamani gecmis faturalarin durumunu odenmedi olarak degistirir
        $schedule->command('update:invoice-status')->daily();
        // ----end----- bu ozellik odeme zamani gecmis faturalarin durumunu odenmedi olarak degistirir
        // bu ozelligin calismasi icin sunucu tarafinda gorev zamanlayiciyi calismamiz lazim
        // * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
