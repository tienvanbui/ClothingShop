<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'coupons';
    protected $fillable = ['coupon_code', 'coupon_condition', 'coupon_use_number', 'coupon_used_count', 'coupon_price_discount'];
 
}
