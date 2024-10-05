<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    protected $table = 'banks';

    protected $fillable = [
        'unique_id', 'name', 'description', 'is_active'
    ];

    protected $dates = [ 'deleted_at' ];

    protected $casts = [];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
