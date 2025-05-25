<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GSTSlab extends Model
{
    use HasFactory;

    protected $table = 'gst_slabs';

    protected $fillable = [
        'percentage', 'description',
    ];
}
