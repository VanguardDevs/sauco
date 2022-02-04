<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ApplyFine;
use App\Console\Commands\RetrievePetroPrice;
use App\Console\Commands\CreateNewYear;
use App\Console\Commands\ExpireLicense;

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
        CreateNewYear::class,
        ExpireLicense::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('get:petro-price')
            ->lastDayOfMonth('21:00');

        $schedule->command('expire:licenses')
            ->dailyAt('01:00');

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
