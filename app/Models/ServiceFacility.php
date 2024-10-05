<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceFacility extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'services_facilitys';

    protected $fillable = [
        'title_en', 'title_ar', 'service_id', 'description_en', 'description_ar', 'icon', 'status'
    ];
    

    public function category()
    {
        return $this->hasOne('App\Models\service', 'id', 'service_id');
    }
    
}