<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ScheduledClass extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        "date_time" => "datetime",
    ];

    public function instructor() : BelongsTo {
        return $this->belongsTo(User::class, "instructor_id");
    }

    public function classType() : BelongsTo{
        return $this->belongsTo(ClassType::class, "class_type_id");
    }

    public function members() : BelongsToMany {
        return $this->belongsToMany(User::class, "bookings");
    }

    public function scopeUpcoming(Builder $query) : Builder {
        return $query->where("date_time", ">", now());
    }

    public function scopeNotBooked(Builder $query) : BUilder{
        return $query->whereDoesntHave("members", function ($query) {
            $query->where("user_id", auth()->id());
        });
    }
}
