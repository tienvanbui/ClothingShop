<?php

namespace App\Models;

use App\Events\checkProductIsEmptyEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'carts';
    protected $fillable = ['user_id'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products', 'cart_id', 'product_id')->withPivot('buy_quanlity', 'color_id', 'size_id', 'total_price');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
