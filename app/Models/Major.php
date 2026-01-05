<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $table = 'major';

    protected $fillable = [
        'major_name',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function degrees()
    {
        return $this->belongsToMany(Degree::class, 'degree_major');
    }
}
