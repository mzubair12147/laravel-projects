<?php

namespace App\Console\Commands;

use App\Models\ScheduledClass;
use Illuminate\Console\Command;

class IncrementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increment-date {--days=1 : The number of days to increment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment Scheduled Classes Dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');

        $scheduledClasses = ScheduledClass::latest('date_time')->get();

        $scheduledClasses->each(function ($scheduledClass) use ($days) {
            $scheduledClass->date_time = $scheduledClass->date_time->addDays($days);
            $scheduledClass->save();
        });

        $this->info("Incremented dates by {$days} day(s).");
    }
}
