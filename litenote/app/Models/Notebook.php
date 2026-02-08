<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notebook extends Model
{
    public $guarded = [];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
