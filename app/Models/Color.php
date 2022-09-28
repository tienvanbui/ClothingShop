<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductQuanlities;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'color_name'
    ];
    protected $table = 'colors';
    public function setColorNameAttribute($value){
        $this->attributes['color_name'] = ucwords($value);
    }
    public function products(){
        return $this->belongsToMany(Product::class,'color_products','color_id','product_id');
    }
    public function productColorSizeses(){
        return $this->hasMany(ProductQuanlities::class);
    }
    
}
