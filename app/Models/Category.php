<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete


class Category extends Model
{
    use HasFactory;

    use SoftDeletes; //dòng này để tự động thêm điều kiện delete_at = null vào câu query khi xóa dữ liệu

    // Nhung filed duoc phep insert data
    protected $fillable = ['name', 'parent_id', 'slug'];
}