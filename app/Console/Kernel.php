<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Backuplog;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
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
        $db     = \Config::get('database.connections.mysql.database');
        $user   = \Config::get('database.connections.mysql.username');
        $pass   = \Config::get('database.connections.mysql.password');
        $filename = date('Y-m-d-His')."_full_megatech.sql";
        Backuplog::create([
            "title" => "DB Daily Backup",
            "content" => "",
            "filename" => $filename,
        ]);
        $filepath = storage_path()."/app/backup/".$filename;

        $schedule->exec("mysqldump --user={$user} --password={$pass} {$db} > {$filepath}")
        //$schedule->exec("mysqldump --user={$user} --password={$pass} {$db} > {$storage_path}\full_megatech.sql")
            ->everyMinute()
            ->runInBackground();
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
