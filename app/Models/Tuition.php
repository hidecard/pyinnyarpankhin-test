<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;

    protected $table = 'tuition';

    protected $fillable = [
        'degree_id',
        'fees',
    ];

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}
