<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'payment_id',
        'total',
        'address_shipping',
        'phoneNumber_shipping',
        'status',
    ];
    public function getAddressShippingAttribute($val)
    {
        return ucwords($val);
    }
    public function getphoneNumberShipping($val)
    {
        return "+084" . $val;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')->withPivot('buy_quanlity', 'color_id', 'size_id');
    }
    public function userCart()
    {
        return $this->user->cart()->first();
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public static function getColorName($color_id)
    {
        return (DB::table('colors')->whereId($color_id)->first())->color_name;
    }
    public static function getSizeName($size_id)
    {
        return (DB::table('sizes')::whereId($size_id)->first())->size_name;
    }
   
}
