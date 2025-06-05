<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use function PHPSTORM_META\map;

class Atlethe extends Model
{
    use HasSlug;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'extrainfo',
        'published',
        'created_by',
        'updated_by',
        'deleted_by',
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function atlethe_images()
    {
        return $this->hasMany(AtletheImage::class);
    }





}
