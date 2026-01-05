<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Duration extends Model
{
    use HasFactory;

    protected $table = 'duration';

    protected $fillable = [
        'length',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($duration) {
            // Delete all degrees associated with this duration
            $duration->degrees()->delete();
        });
    }

    public function degrees(): HasMany
    {
        return $this->hasMany(Degree::class);
    }
}
