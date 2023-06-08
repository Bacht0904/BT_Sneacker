<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'user_id',
        'num_rate',
        'description',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')
        ->with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function pictures_rate()
    {
        return $this->hasMany(PictureRate::class, 'rate_id', 'id');
    }
}