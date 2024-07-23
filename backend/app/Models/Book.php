<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    private string $thumbStoragePath = '/books/thumb';

    protected $appends = [
        'thumb_url'
    ];

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the Book category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(User::class, 'category_id', 'id');
    }

    /**
     * Get the Book publisher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo     
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'publisher_id', 'id');
    }
     */

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

