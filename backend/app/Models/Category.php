<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    private string $thumbStoragePath = '/categories/thumb';

    protected $appends = [
        'thumb_url'
    ];

    /**
     * Get all of the books for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }

    public function getThumbUrlAttribute(): string
    {           
        $public_storage = asset('/storage');
        $thumb_path = $this->getAttribute('thumb');

        return "$public_storage/$thumb_path";
    }

    public function getThumbStoragePath()
    {
        return $this->thumbStoragePath;
    }
}
