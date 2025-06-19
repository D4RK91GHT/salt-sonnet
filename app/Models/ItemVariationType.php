<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ItemVariation;

class ItemVariationType extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'variation_types';

    protected $fillable = [
        'name', 'description', 'is_required', 'display_order',
    ];

    public function variations()
    {
        return $this->hasMany(ItemVariation::class, 'variation_type_id', 'id');
    }
}
