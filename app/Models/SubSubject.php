<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubject extends Model
{
    protected $fillable = ['sub_id', 'name', 'status', 'remark'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'sub_id');
    }
}
