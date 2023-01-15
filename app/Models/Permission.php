<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    //access all fields insert
    protected $guarded = [];

    // 1 PermissionParent - many PermissionsChildren
    public function permissionChildrents()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}