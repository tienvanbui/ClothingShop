<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "banners";
    protected $fillable = [
        'title',
        'content',
        'banner_image'
    ];
    public function setTitleAttribute($value){
        $this->attributes['title'] = ucwords($value);
    }
    public function setContentAttribute($value){
        $this->attributes['content'] = ucwords($value);
    }
}
