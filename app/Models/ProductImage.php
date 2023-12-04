<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'product_color_sizes_id', 'image'];

    public function productColorSize()
    {
        return $this->belongsTo(ProductColorSize::class);
    }
}
