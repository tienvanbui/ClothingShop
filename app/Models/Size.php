<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductQuanlities;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'size_name'
    ];
    protected $table = 'sizes';
    public function setSizeNameAttribute($value){
        $this->attributes['size_name'] = ucwords($value);
    }
    public function getSizeNameAttribute($value){
        return 'Size'.' '.$value;
    }
    public function products(){
        return $this->belongsToMany(Product::class,'product_size','size_id','product_id');
    }
    public function productColorSizeses(){
        return $this->hasMany(ProductQuanlities::class);
    }
    
}
