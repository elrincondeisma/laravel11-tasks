<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;

class ToolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Herramientas para el gestor de tareas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $task = select(
            label: 'Que tarea quieres escoger?',
            options: Task::all()->pluck('title', 'id'),
            scroll: 10
        );
        dd($task);
    }
}
