<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ApplyFine;
use App\Console\Commands\RetrievePetroPrice;
use App\Console\Commands\CreateNewYear;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ApplyFine::class,
        RetrievePetroPrice::class,
        CreateNewYear::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('apply:fine')
            ->monthlyOn(16, '01:42')
            ->lastDayOfMonth('01:42')
            ->evenInMaintenanceMode();

        $schedule->command('get:petro-price')
            ->dailyAt('09:00');

        $schedule->command('create:year')
            ->yearly();
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'America/Caracas';
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
