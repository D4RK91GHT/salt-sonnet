<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVariation extends Model
{
    protected $fillable = [
        'variation_type_id',
        'menu_item_id',
        'name',
        'description',
        'price',
        'is_default',
        'is_active',
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function variationType()
    {
        return $this->belongsTo(ItemVariationType::class);
    }

    // public function variationType()
    // {
    //     return $this->belongsTo(ItemVariationType::class);
    // }

    // public function options()
    // {
    //     return $this->belongsToMany(VariationOption::class);
    // }
}
