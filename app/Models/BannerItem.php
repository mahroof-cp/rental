<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerItem extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'banner_id', 'file', 'title_en', 'title_ar', 'description_en', 'description_ar', 'link'
    ];

    public function banner()
    {
        return $this->belongsTo('App\Models\Banner', 'banner_id', 'id');
    }

    public function getTitleAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->attributes['title_ar'] : $this->attributes['title_en'];
    }

    public function getDescriptionAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->attributes['description_ar'] : $this->attributes['description_en'];
    }
}