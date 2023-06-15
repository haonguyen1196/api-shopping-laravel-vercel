<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = array();

    // when insert data to table product image, will get id product table to product image
    public function images () 
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // get id table product and id tag table send to table product tag
    public function tags () 
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }
    //get name value from category table by category id from product table
    public function categories () {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
