<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meet;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Room extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['title', 'description'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function meets()
    {
        return $this->hasMany(Meet::class);
    }
}
