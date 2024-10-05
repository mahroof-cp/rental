<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name', 'is_active'
    ];

    protected $casts = [];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "role_permissions", "role_id", "permission_id");
    }

    public function permissionList()
    {
        return $this->belongsToMany(Permission::class, "role_permissions", "role_id", "permission_id")
            ->pluck("permissions.id")
            ->toArray();
    }

    public function hasPermission($permission)
    {
        if (auth()->user()->role->name === 'Rental Admin') {
            return true;
        }

        return $this->permissions()->where('name', $permission)->exists();
    }

}
