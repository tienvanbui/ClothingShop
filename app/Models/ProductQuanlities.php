<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Product;
use App\Models\Color;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQuanlities extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "product_color_sizes";
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'quanlities'
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
}
