<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SearchFilesCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Регистрация всех консольных команд в приложении.
     *
     * @var array
     */
    protected $commands = [
        SearchFilesCommand::class,  // Регистрируем Нашу команду
    ];

    /**
     * Определите расписание команд.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Задачи планирования
    }

    /**
     * Регистрация команд в консольном приложении.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
