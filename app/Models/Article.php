<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $dates = ['published_at'];
    protected $casts = [
    'published_at' => 'datetime',
];


    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the user that authored the article
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include published articles.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    /**
     * Auto-generate excerpt from body if not provided
     */
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        return \Str::limit(strip_tags($this->body), 200);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
