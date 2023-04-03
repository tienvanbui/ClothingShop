<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Color;
use App\Models\Size;
use App\Models\Cart;
use App\Models\ProductQuanlities;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_name',
        'product_image',
        'product_image_name',
        'price',
        'category_id',
        'is_love',
        'user_id',
        'seo_product',
        'viewed_count_number'
    ];
    public function setProductNameAttribute($value)
    {
        $this->attributes['product_name'] = ucwords($value);
    }
    public function getPriceAttribute($value)
    {
        return $value;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products', 'product_id', 'color_id');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products', 'product_id', 'cart_id')->withPivot('buy_quanlity', 'color_id', 'size_id', 'total_price');;
    }
    public function productColorSizeses()
    {
        return $this->hasMany(ProductQuanlities::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id')->withPivot('buy_quanlity', 'color_id', 'size_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function discounts(){
        return $this->belongsToMany(Discount::class,'discount_products','product_id','discount_id');
    }
}
