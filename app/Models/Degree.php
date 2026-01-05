<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Degree extends Model
{
    use HasFactory;

    protected $table = 'degree';

    protected $fillable = [
        'degree_name',
        'duration_id',
        'level',
        'department_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($degree) {
            // Detach all majors associated with this degree
            $degree->majors()->detach();
        });
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function majors(): BelongsToMany
    {
        return $this->belongsToMany(Major::class, 'degree_major');
    }
}
