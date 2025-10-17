<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_item_id',
        'quantity',
        'unit_price',
        'total_price',
        'special_instructions',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

    public function variations()
    {
        return $this->belongsToMany(ItemVariation::class, 'order_item_variations', 'order_item_id', 'variation_id')
            ->withPivot('variation_price')
            ->withTimestamps();
    }

    public function getTotalVariationsPriceAttribute()
    {
        return $this->variations->sum(function ($variation) {
            return $variation->pivot->variation_price;
        });
    }

    public function getDisplayPriceAttribute()
    {
        $basePrice = $this->menuItem->price ?? 0;
        $variationsPrice = $this->total_variations_price;

        return $basePrice + $variationsPrice;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($orderItem) {
            if ($orderItem->unit_price === null && $orderItem->menuItem) {
                $orderItem->unit_price = $orderItem->display_price;
            }

            if ($orderItem->total_price === null) {
                $orderItem->total_price = $orderItem->unit_price * $orderItem->quantity;
            }
        });
    }
}
