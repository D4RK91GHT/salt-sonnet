<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'menu_item_id',
        'quantity',
        'guest_identifier',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    public function variations()
    {
        // cart_item_variations: item_id -> cart_items.id, variation_id -> item_variations.id
        return $this->belongsToMany(ItemVariation::class, 'cart_item_variations', 'item_id', 'variation_id')
            ->withTimestamps();
    }
}
