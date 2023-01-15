<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;

    use SoftDeletes; //dòng này để tự động thêm điều kiện delete_at = null vào câu query khi xoá dữ liệu

    // Nhung filed duoc phep insert data
    protected $fillable = ['name', 'parent_id', 'slug'];
}