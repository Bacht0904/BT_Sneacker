<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function product_types()
    {
        return $this->hasMany(ProductType::class, 'categorie_id', 'id')->where('product_types.status', '=', 1);
    }
}
