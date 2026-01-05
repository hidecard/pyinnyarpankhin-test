<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeDetail extends Model
{
    use HasFactory;

    protected $table = 'intake_detail';

    protected $fillable = [
        'intake_id',
        'event_name',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function intake()
    {
        return $this->belongsTo(Intake::class);
    }
}
