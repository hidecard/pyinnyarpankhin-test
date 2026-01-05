<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'cover_image_path',
        'file_path',
    ];

    // Get the cover image URL
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image_path) {
            return asset('storage/' . $this->cover_image_path);
        }
        return null;
    }

    // Get the PDF file URL
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    // Scope for searching
    public function scopeSearch($query, $search, $searchType = null)
    {
        if (!$search) {
            return $query;
        }

        if ($searchType === 'author') {
            return $query->where('author', 'like', "%{$search}%");
        } elseif ($searchType === 'title') {
            return $query->where('title', 'like', "%{$search}%");
        } else {
            // Default: search both if no type specified
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        }
    }
}
