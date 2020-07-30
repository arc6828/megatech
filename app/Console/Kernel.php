<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Backuplog;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;

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
        $filename = date('Y-m-d-His')."_full_megatech.sql";
        $db     = \Config::get('database.connections.mysql.database');
        $user   = \Config::get('database.connections.mysql.username');
        $pass   = \Config::get('database.connections.mysql.password');        
        

        //DAILY BACKUP
        $cmd = sprintf(
            'mysqldump -u %s -p%s %s > %s &&',
            \Config::get('database.connections.mysql.username'),
            \Config::get('database.connections.mysql.password'),
            \Config::get('database.connections.mysql.database'),
            storage_path('app/backup/'.$filename)
        );
        $schedule->exec($cmd)
            ->daily()
            ->after(function () use($filename) {
                if (Schema::hasTable('backuplogs')) {
                    $filesize = file_exists(storage_path('app/backup/'.$filename)) ? "" .(filesize(storage_path('app/backup/'.$filename)) / pow(1024, 2))." MB" : '';
                    Backuplog::create([
                        "title" => "DB Daily Backup",
                        "content" => $filesize,
                        "filename" => $filename,
                    ]);
                }
            });

        //RESTART MYSQL
        $cmd = sprintf('service mysql restart');
        $schedule->call(function (){
            // Test database connection
            try {
                DB::connection()->getPdo();
                echo "Database connected successfully!!!\n"; 
            } catch (\Exception $e) {
                echo "die\n";
                //COMMAND TO RESTART
                $result = shell_exec("service mysql restart");
                if($result == ""){
                    try {
                        DB::connection()->getPdo();
                        echo "Database connected successfully!!!"; 
                    } catch (\Exception $e) {
                        echo "die again";                            
                    } 
                }
                


                /*if (Schema::hasTable('backuplogs')) {                    
                    Backuplog::create([
                        "title" => "Mysql Restart",
                        "content" => $filesize,
                        "filename" => $filename,
                    ]);
                }*/
            }

                /*if (Schema::hasTable('backuplogs')) {                    
                    Backuplog::create([
                        "title" => "Mysql Restart",
                        "content" => $filesize,
                        "filename" => $filename,
                    ]);
                }*/
        })
        ->everyMinute();            
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
