<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'includes', 'description', 'category_id', 'mrp', 'discount', 'gst', 'price', 'is_available', 'image',
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'item_id');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class, 'item_id')->where('is_primary', true);
    }
}
