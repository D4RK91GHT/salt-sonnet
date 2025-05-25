<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'item_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
