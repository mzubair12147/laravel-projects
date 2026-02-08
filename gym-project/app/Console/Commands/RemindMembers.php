<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class RemindMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = User::query()->where("role", "member")->whereDoesntHave("bookings", function ($query) {
            return $query->where("date_time", ">=", now());
        })->select('name', "email")->get();

        $this->table(['name', 'email'], $members);
        Notification::send($members, new RemindMembers());
    }
}
