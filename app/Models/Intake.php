<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    use HasFactory;

    protected $table = 'intake';

    protected $fillable = ['name'];

    public function intakeDetails()
    {
        return $this->hasMany(IntakeDetail::class, 'intake_id');
    }
}
