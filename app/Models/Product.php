<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $fillable = ['name', 'price', 'content', 'user_id', 'category_id', 'feature_image_name', 'feature_image_path'];

    //access all fields insert
    protected $guarded = [];

    //one main image product have multiple sub image  (1-many)
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id'); // product_id is foreign key with product_images table
    }

    //products table with tags table (many-many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps(); //product_tags is intermediate table

    }

    //(product many - 1 category)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); //get name of category in product.index
    }
}