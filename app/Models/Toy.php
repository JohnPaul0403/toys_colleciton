<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Toy extends Model implements HasMedia
{
    use HasSlug;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'title',
        'description',
        'price',
        'sold',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected static function booted(): void
    {
        static::creating(function (Toy $toy) {
            $toy->sold = false;
        });
    }
}
