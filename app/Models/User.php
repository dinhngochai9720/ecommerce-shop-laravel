<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //users table with roles table (many-many)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')->withTimestamps(); //user_role is intermediate table

    }

    public function checkPermissionAccess($key_code)
    {
        //User dang login va co quyen xem danh sach san pham
        //B1: Lay cac tat ca cac quyen user dang login he thong
        // $all_roles = auth()->user()->roles; //get roles of users
        $all_roles = auth()->user()->roles;
        // dd($all_roles);

        //B2: So sanh gia tri dua vao cua router hien tai xem co ton tai trong cac quyen lay duoc hay khong
        foreach ($all_roles as $role) {
            //get all permissions of role
            $all_permissions = $role->permissions; //permissions is method is Role Model
            // dd($all_permissions);

            if ($all_permissions->contains('key_code', $key_code)) {
                return true;
            }
        }

        //if do not permission
        return false;
    }
}