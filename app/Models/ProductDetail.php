<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'description',
        'weight',
        'dimension',
        'materials',
        'product_id',
    ];
    public function setDescriptionAttribute($val){
        return $this->attributes['description'] = ucwords($val);
    }
    public function setMaterialsAttribute($val){
        return $this->attributes['materials'] = ucwords($val);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
