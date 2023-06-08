<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_barcode',
        'product_name',
        'stock',
        'brand_id',
        'import_price',
        'price',
        'discount_price',
        'product_type_id',
        'description',
        'vat',
        'popular',
        'status',
        'num_like',
    ];

    use HasFactory;
    public function pictures()
    {
        return $this->hasMany(Picture::class, 'product_id', 'id')->where('pictures.status', '=', 1);
    }
    public function sizes()
    {
        return $this->hasMany(Size::class, 'product_id', 'id')->where('sizes.status', '=', 1);
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'product_id', 'id');
    }
}
