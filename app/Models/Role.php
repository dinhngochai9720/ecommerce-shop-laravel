<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    //access all fields insert
    protected $guarded = [];

    public function permissions()
    {
        //roles table - permissions table (many - many )
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}