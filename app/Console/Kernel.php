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
        Commands\QueueActivationCommand::class,
        'App\Console\Commands\CallRoute',
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
        //          ->hourly();

        //$schedule->command('queue:work --queue=aktivasi')->everyMinute()->withoutOverlapping();

        if (\App\Util\OS::isWindows()) {
            exec("wmic process get commandline | find \"--queue=aktivasi\"", $output);
        } else {
            exec("ps -ax | grep \"queue:work --queue=aktivasi\" | grep -v grep", $output);
        }

        $isRunning = false;
        if (is_array($output) && !empty($output)) {
            $isRunning = str_contains($output[0], 'artisan queue:work --queue=aktivasi');
        }

        /*
        if (!$isRunning) {
            \App\Util\Command::factory('queue:work --queue=aktivasi')->runInBackground();
        }*/

        if (!$isRunning) {
            $schedule->exec(
                \App\Util\Command::factory('queue:work --queue=aktivasi')->composeForRunInBackground()
            );
        }

        //$schedule->command('queue:aktivasi')->everyMinute()->withoutOverlapping();
        // Backup data dan database setiap jam 1 malam
        $schedule->command('backup:monitor')->daily()->at('01:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
