<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name_en', 'company_name_ar', 'company_description_en', 'company_description_ar', 'key', 'value', 'autoload'
    ];
}