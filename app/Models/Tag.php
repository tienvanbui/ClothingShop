<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['tag_name'];
    protected $table = 'tags';
    public function setTagNameAttribute($value){
        $this->attributes['tag_name'] = ucwords($value);
    }
    public function blogs(){
        return $this->belongsToMany(Blog::class,'blog_tag','tag_id','blog_id');
    }
}
