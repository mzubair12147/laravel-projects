<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScheduledClassPolicy
{
    public function delete(User $user, ScheduledClass $scheduledClass) : bool {
        return $user->id === $scheduledClass->instructor_id;
    }
}
