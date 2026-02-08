<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassType extends Model
{
    protected $guarded = [];

    public function scheduledClasses() : HasMany{
        return $this->hasMany(ScheduledClass::class, "class_type_id");
    }
}
