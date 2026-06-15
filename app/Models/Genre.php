<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $fillable = ['name', 'slug'];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }
}
