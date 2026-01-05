<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = [
        'admissions_name',
        'email',
        'phone',
        'department_id',
        'minimum_gpa',
        'transcripts',
        'recommendation',
        'edu_degree',
        'sop',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
