<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;
    protected $table ='permissions';
    protected $fillable = [
        'permission_name', // string
        'permission_description',//string
        'parent_id', //integer
        'key_code', //string
    ];
    public function setPermissionNameAttribute($val){
        $this->attributes['permission_name'] = ucwords($val);
    }
    public function setPermissionDescriptionAttribute($val){
        $this->attributes['permission_description'] = ucwords($val);
    }
    public function permissions(){
        return $this->hasMany(Permission::class,'parent_id');
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
