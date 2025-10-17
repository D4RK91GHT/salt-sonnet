<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItemVariation extends Pivot
{
    protected $table = 'order_item_variations';

    protected $fillable = [
        'order_item_id',
        'variation_id',
        'variation_price',
    ];

    protected $casts = [
        'variation_price' => 'decimal:2',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'variation_id');
    }
}
