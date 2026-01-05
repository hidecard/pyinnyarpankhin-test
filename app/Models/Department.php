<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department';

    protected $fillable = [
        'department_name',
        'description',
        'programs',
        'research_areas',
        'career_pathways',
    ];

    public function majors()
    {
        return $this->hasMany(Major::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
}
