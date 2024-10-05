<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsPage extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'cms_category_id', 'name', 'title_en', 'title_ar', 'html_en', 'html_ar', 'file', 'thumbnail', 'slug', 'is_deletable', 'status'
    ];

    protected $appends = [
        'title', 'html'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getTitleAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->attributes['title_ar'] : $this->attributes['title_en'];
    }

    public function getHtmlAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->attributes['html_ar'] : $this->attributes['html_en'];
    }

    public function category()
    {
        return $this->hasOne('App\Models\CmsCategory', 'id', 'cms_category_id');
    }
}