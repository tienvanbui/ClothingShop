<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'roles';
    protected $fillable = [
        'role_name',
        'role_description'
    ];
    public function users(){
        return $this->hasMany(User::class);
    }
    public function getRoleNameAttribute(){
        return ucwords($this->attributes['role_name']);
    }
    public function getRoleDescriptionAttribute(){
        return ucwords($this->attributes['role_description']);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }
}
