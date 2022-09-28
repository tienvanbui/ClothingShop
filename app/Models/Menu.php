<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
    ];
    public function menus(){
        return $this->hasMany(Menu::class,'parent_id');
    }
    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }
    public function setSlugAttribute($value){
        $this->attributes['slug'] = strtolower($value);
    }
}
