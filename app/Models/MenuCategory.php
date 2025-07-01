<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MenuItem;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'status',
    ];
    
    public function items()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }
}
