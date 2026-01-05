<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'status'];

    public function subSubjects()
    {
        return $this->hasMany(SubSubject::class, 'sub_id');
    }
}
