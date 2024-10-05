<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Banner extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasSlug;

    protected $table = 'banners';

    protected $fillable = [
        'name', 'status', 'slug', 'multiple', 'is_deletable'
    ];

    protected $appends = [
        'file', 'title', 'description'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function items()
    {
        return $this->hasMany('App\Models\BannerItem', 'banner_id', 'id');
    }

    public function item()
    {
        return $this->hasOne('App\Models\BannerItem', 'banner_id', 'id');
    }

    public function getFileAttribute()
    {
        return $this->item ? $this->item->file : "";
    }

    public function getTitleAttribute()
    {
        return $this->item ? $this->item->title : "";
    }

    public function getDescriptionAttribute()
    {
        return $this->item ? $this->item->description : "";
    }
}