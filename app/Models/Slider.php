<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'sliders';
    protected $fillable = [
        'title', //string
        'slider_image', //string
        'description', // string
    ];
    public function setTitleAttribute($value){
        $this->attributes['title'] = ucwords($value);
    }
}
