<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\BACKUP_LOG;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     * @link http://www.cyberciti.biz/faq/how-do-i-add-jobs-to-cron-under-linux-or-unix-oses/
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        // This scheduled task backs up the db at midnight everyday
        $serial_num = BACKUP_LOG::max('serial_num');
        $newSerial_num = sprintf('%08d', $serial_num + 1);

        $currentSerialNum = BACKUP_LOG::find($serial_num);
        $currentSerialNum->serial_num = $newSerial_num;
        $currentSerialNum->save();

        // This shell command will be executed at Midnight everyday
        $schedule->exec('mysqldump -u'.env('DB_USERNAME').' -p'.env('DB_PASSWORD').' '.env('DB_DATABASE').' > '.env('BACKUP_PATH').$newSerial_num."_scheduled_backup_`date`".'.sql')
            ->daily();
    }
}
