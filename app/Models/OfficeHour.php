<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OfficeHour extends Model
{
   
    protected $table = 'office_hours';

    protected $fillable = [
        'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'
    ];
}