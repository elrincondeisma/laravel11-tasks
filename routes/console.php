<?php

use App\Console\Commands\DeleteTaskPending;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(DeleteTaskPending::class)->timezone('Europe/Madrid')->everyMinute();


