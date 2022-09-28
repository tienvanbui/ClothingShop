<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'payments';
    protected $fillable = ['payment_method'];
    public function setPaymentMethodAttribute($val)
    {
        $this->attributes['payment_method'] = ucwords($val);
    }
    public function setSlugAttribute($val)
    {
        $this->attributes['slug'] = ucwords($val);
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
